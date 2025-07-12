<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\ZenzivaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class WhatsappAuthController extends Controller
{
    protected $zenzivaService;

    public function __construct(ZenzivaService $zenzivaService)
    {
        $this->zenzivaService = $zenzivaService;
    }

    // --- REGISTER VIA WHATSAPP ---

    /**
     * Menampilkan form pendaftaran nomor WhatsApp dan referral.
     */
    public function showRegisterForm()
    {
        return view('auth.register-whatsapp');
    }

    /**
     * Mengirim OTP ke nomor WhatsApp yang didaftarkan.
     */
    public function registerSendOtp(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'regex:/^62[0-9]{9,13}$/', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'referred_by' => ['nullable', 'string', 'exists:users,referral_code'],
        ]);

        $phoneNumber = $request->phone_number;
        $otpCode = rand(100000, 999999); // Lebih baik pakai angka untuk OTP
        // Buat OTP acak 6 digit numerik

        // Simpan data sementara di session
        session([
            'registration_data' => [
                'name' => $request->name,
                'phone_number' => $phoneNumber,
                'password' => Hash::make($request->password),
                'referred_by' => $request->referred_by,
                'otp_code' => (string)$otpCode, // Simpan sebagai string
                'otp_expires_at' => Carbon::now()->addMinutes(5), // OTP berlaku 5 menit
            ]
        ]);

        // Panggil metode baru untuk WhatsApp Official API
        $response = $this->zenzivaService->sendWhatsAppOfficialOtp($phoneNumber, (string)$otpCode);

        if ($response['status'] === 'success') {
            return redirect()->route('register.verify')->with('success', 'Kode OTP telah dikirim ke nomor WhatsApp Anda. Mohon masukkan kode untuk verifikasi.');
        } else {
            // Log detail error dari Zenziva untuk debugging lebih lanjut
            Log::error('Zenziva WhatsApp OTP Send Failed from registerSendOtp: ' . ($response['message'] ?? 'Unknown error'), [
                'phone_number' => $phoneNumber,
                'zenziva_raw_response' => $response['raw_response'] ?? 'N/A'
            ]);
            return back()->withInput()->with('error', 'Gagal mengirim OTP ke WhatsApp. Silakan coba lagi. Error: ' . ($response['message'] ?? 'Terjadi kesalahan sistem.'));
        }
    }

    /**
     * Menampilkan form verifikasi OTP pendaftaran.
     */
    public function showRegisterVerifyForm()
    {
        if (!session('registration_data')) {
            return redirect()->route('whatsapp.register')->with('error', 'Sesi pendaftaran tidak ditemukan. Silakan mulai kembali.');
        }
        return view('auth.verify-otp');
    }

    /**
     * Memverifikasi OTP dan menyelesaikan pendaftaran.
     */
    public function registerVerifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => ['required', 'string', 'size:6'],
        ]);

        $registrationData = session('registration_data');

        if (!$registrationData) {
            return redirect()->route('whatsapp.register')->with('error', 'Sesi pendaftaran berakhir atau tidak valid. Silakan coba daftar kembali.');
        }

        if ($request->otp_code !== $registrationData['otp_code']) {
            throw ValidationException::withMessages(['otp_code' => 'Kode OTP tidak valid.']);
        }

        if (Carbon::now()->isAfter($registrationData['otp_expires_at'])) {
            session()->forget('registration_data'); // Hapus sesi jika OTP kadaluarsa
            throw ValidationException::withMessages(['otp_code' => 'Kode OTP telah kadaluarsa. Silakan kirim ulang OTP.']);
        }

        // OTP valid, buat user baru
        $referralCode = Str::random(8); // Kode referral unik untuk user baru ini
        while (User::where('referral_code', $referralCode)->exists()) {
            $referralCode = Str::random(8);
        }

        $user = User::create([
            'name' => $registrationData['name'],
            'phone_number' => $registrationData['phone_number'],
            'phone_number_verified_at' => Carbon::now(), // Langsung verifikasi setelah OTP
            'password' => $registrationData['password'],
            'role' => 'user', // Default role
            'points' => 0, // Default poin
            'referral_code' => $referralCode,
            'referred_by' => $registrationData['referred_by'],
            'first_transaction_awarded' => false,
        ]);

        // Berikan poin referral jika ada referrer
        if ($user->referred_by) {
            $referrer = User::where('referral_code', $user->referred_by)->first();
            if ($referrer) {
                $referrer->points += 10; // Poin untuk user lama
                $referrer->save();
                $user->points += 10; // Poin untuk user baru
                $user->save();
                session()->flash('success', 'Anda berhasil mendaftar dan mendapatkan 10 poin! Referral Anda juga telah memberikan 10 poin kepada teman Anda.');
            }
        } else {
            session()->flash('success', 'Pendaftaran berhasil! Selamat datang di Petshopku.');
        }

        // Hapus sesi pendaftaran
        session()->forget('registration_data');

        Auth::login($user); // Login user secara otomatis

        return redirect(RouteServiceProvider::HOME);
    }


    // --- LOGIN VIA WHATSAPP ---

    /**
     * Menampilkan form login nomor WhatsApp.
     */
    public function showLoginForm()
    {
        return view('auth.login-whatsapp');
    }

        /**
     * Memproses login menggunakan nomor WhatsApp dan password.
     */
    public function authenticate(Request $request) // Ganti nama metode dari 'loginSendOtp' menjadi 'authenticate'
    {
        $request->validate([
            'phone_number' => ['required', 'string', 'regex:/^62[0-9]{9,13}$/'],
            'password' => ['required', 'string'],
        ]);

        $credentials = [
            'phone_number' => $request->phone_number,
            'password' => $request->password,
        ];

        // Attempt to log the user in
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); // Regenerate session ID for security

            return redirect()->intended(RouteServiceProvider::HOME); // Redirect to intended URL or dashboard
        }

        // If authentication fails
        throw ValidationException::withMessages([
            'phone_number' => __('Nomor WhatsApp atau password yang Anda masukkan salah.'),
        ]);
    }


    /**
     * Mengirim OTP untuk login.
     */
    public function loginSendOtp(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'string', 'regex:/^62[0-9]{9,13}$/'],
        ]);

        $phoneNumber = $request->phone_number;
        $user = User::where('phone_number', $phoneNumber)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'phone_number' => 'Nomor WhatsApp tidak terdaftar.',
            ]);
        }

        $otpCode = rand(100000, 999999); // Generate OTP numerik
        $user->otp_code = (string)$otpCode;
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        // Panggil metode baru untuk WhatsApp Official API
        $response = $this->zenzivaService->sendWhatsAppOfficialOtp($phoneNumber, (string)$otpCode);

        if ($response['status'] === 'success') {
            session(['login_phone_number' => $phoneNumber]);
            return redirect()->route('whatsapp.login.verify')->with('success', 'Kode OTP telah dikirim ke nomor WhatsApp Anda untuk login.');
        } else {
            // Log detail error dari Zenziva
            Log::error('Zenziva WhatsApp OTP Send Failed from loginSendOtp: ' . ($response['message'] ?? 'Unknown error'), [
                'phone_number' => $phoneNumber,
                'zenziva_raw_response' => $response['raw_response'] ?? 'N/A'
            ]);
            return back()->withInput()->with('error', 'Gagal mengirim OTP ke WhatsApp. Silakan coba lagi. Error: ' . ($response['message'] ?? 'Terjadi kesalahan sistem.'));
        }
    }

    /**
     * Menampilkan form verifikasi OTP login.
     */
    // public function showLoginVerifyForm()
    // {
    //     if (!session('login_phone_number')) {
    //         return redirect()->route('whatsapp.login')->with('error', 'Sesi login tidak ditemukan. Silakan mulai kembali.');
    //     }
    //     return view('auth.verify-otp-login'); // View terpisah untuk verifikasi login
    // }

    /**
     * Memverifikasi OTP dan menyelesaikan login.
     */
    // public function loginVerifyOtp(Request $request)
    // {
    //     $request->validate([
    //         'otp_code' => ['required', 'string', 'size:6'],
    //     ]);

    //     $phoneNumber = session('login_phone_number');
    //     $user = User::where('phone_number', $phoneNumber)->first();

    //     if (!$user) {
    //         return redirect()->route('whatsapp.login')->with('error', 'Sesi login berakhir atau tidak valid.');
    //     }

    //     if ($request->otp_code !== $user->otp_code) {
    //         throw ValidationException::withMessages(['otp_code' => 'Kode OTP tidak valid.']);
    //     }

    //     if (Carbon::now()->isAfter($user->otp_expires_at)) {
    //         $user->otp_code = null;
    //         $user->otp_expires_at = null;
    //         $user->save();
    //         throw ValidationException::withMessages(['otp_code' => 'Kode OTP telah kadaluarsa. Silakan kirim ulang OTP.']);
    //     }

    //     // OTP valid, login user
    //     $user->otp_code = null; // Hapus OTP setelah berhasil
    //     $user->otp_expires_at = null;
    //     $user->save();

    //     Auth::login($user); // Login user secara otomatis
    //     session()->forget('login_phone_number'); // Hapus sesi

    //     return redirect(RouteServiceProvider::HOME);
    // }

    /**
     * Login dengan password biasa (sebagai fallback/opsional)
     */
    // public function loginWithPassword(Request $request)
    // {
    //     $request->validate([
    //         'phone_number' => ['required', 'string', 'regex:/^62[0-9]{9,13}$/'],
    //         'password' => ['required', 'string'],
    //     ]);

    //     $credentials = [
    //         'phone_number' => $request->phone_number,
    //         'password' => $request->password,
    //     ];

    //     if (Auth::attempt($credentials, $request->boolean('remember'))) {
    //         $request->session()->regenerate();
    //         return redirect()->intended(RouteServiceProvider::HOME);
    //     }

    //     throw ValidationException::withMessages([
    //         'phone_number' => 'Nomor WhatsApp atau password salah.',
    //     ]);
    // }
}