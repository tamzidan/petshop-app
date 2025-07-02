<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ZenzivaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Pastikan ini di-import
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class WhatsappPasswordResetController extends Controller
{
    protected $zenzivaService;

    public function __construct(ZenzivaService $zenzivaService)
    {
        $this->zenzivaService = $zenzivaService;
    }

    /**
     * Menampilkan form untuk meminta reset password (input nomor WhatsApp).
     */
    public function showRequestForm()
    {
        return view('auth.forgot-password-whatsapp');
    }

    /**
     * Mengirim OTP ke nomor WhatsApp untuk reset password.
     */
    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'string', 'regex:/^62[0-9]{9,13}$/', 'exists:users,phone_number'],
        ], [
            'phone_number.exists' => 'Nomor WhatsApp tidak terdaftar.',
        ]);

        $phoneNumber = $request->phone_number;
        $user = User::where('phone_number', $phoneNumber)->first();

        $otpCode = rand(100000, 999999); // Generate OTP numerik
        $user->otp_code = (string)$otpCode;
        $user->otp_expires_at = Carbon::now()->addMinutes(5); // OTP berlaku 5 menit
        $user->save();

        $response = $this->zenzivaService->sendWhatsAppOfficialOtp($phoneNumber, (string)$otpCode);

        if ($response['status'] === 'success') {
            session(['password_reset_phone_number' => $phoneNumber]); // Simpan nomor untuk verifikasi
            return redirect()->route('password.verify.whatsapp')->with('success', 'Kode OTP telah dikirim ke nomor WhatsApp Anda untuk reset password.');
        } else {
            Log::error('Zenziva WhatsApp OTP Send Failed for password reset: ' . ($response['message'] ?? 'Unknown error'), [
                'phone_number' => $phoneNumber,
                'zenziva_raw_response' => $response['raw_response'] ?? 'N/A'
            ]);
            return back()->withInput()->with('error', 'Gagal mengirim OTP ke WhatsApp. Silakan coba lagi. Error: ' . ($response['message'] ?? 'Terjadi kesalahan sistem.'));
        }
    }

    /**
     * Menampilkan form verifikasi OTP untuk reset password.
     */
    public function showVerifyForm()
    {
        if (!session('password_reset_phone_number')) {
            return redirect()->route('password.request')->with('error', 'Sesi reset password tidak ditemukan. Silakan mulai kembali.');
        }
        return view('auth.verify-otp-reset-password');
    }

    /**
     * Memverifikasi OTP dan menampilkan form untuk mengatur password baru.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => ['required', 'string', 'size:6'],
        ]);

        $phoneNumber = session('password_reset_phone_number');
        $user = User::where('phone_number', $phoneNumber)->first();

        if (!$user) {
            return redirect()->route('password.request')->with('error', 'Sesi reset password tidak valid.');
        }

        if ($request->otp_code !== $user->otp_code) {
            throw ValidationException::withMessages(['otp_code' => 'Kode OTP tidak valid.']);
        }

        if (Carbon::now()->isAfter($user->otp_expires_at)) {
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();
            throw ValidationException::withMessages(['otp_code' => 'Kode OTP telah kadaluarsa. Silakan kirim ulang OTP.']);
        }

        // OTP valid, simpan penanda di session dan arahkan ke form password baru
        session(['otp_verified_for_password_reset' => true]);
        
        return redirect()->route('password.reset.whatsapp');
    }

    /**
     * Menampilkan form untuk mengatur password baru.
     */
    public function showResetForm()
    {
        if (!session('password_reset_phone_number') || !session('otp_verified_for_password_reset')) {
            return redirect()->route('password.request')->with('error', 'Sesi reset password tidak valid. Silakan mulai kembali.');
        }
        return view('auth.reset-password-whatsapp');
    }

    /**
     * Mengatur password baru setelah verifikasi OTP.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $phoneNumber = session('password_reset_phone_number');
        $user = User::where('phone_number', $phoneNumber)->first();

        if (!$user || !session('otp_verified_for_password_reset')) {
            return redirect()->route('password.request')->with('error', 'Sesi reset password tidak valid.');
        }

        $user->password = Hash::make($request->password);
        $user->otp_code = null; // Hapus OTP setelah password direset
        $user->otp_expires_at = null;
        $user->save();

        Auth::login($user); // Otomatis login setelah reset password
        session()->forget(['password_reset_phone_number', 'otp_verified_for_password_reset']); // Bersihkan sesi

        return redirect('/dashboard')->with('status', 'Password Anda berhasil direset!');
    }
}