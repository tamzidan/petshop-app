<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroomingBooking; // Import model GroomingBooking
use App\Models\User;
use Carbon\Carbon; // Untuk memanipulasi tanggal dan waktu
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroomingBookingController extends Controller
{
    // Data harga dan jenis grooming (sama seperti di GroomingController)
    const GROOMING_OPTIONS = [
        'kitten' => [
            'grooming_premium' => [
                'price' => 40000,
                'benefits' => ['Mandi biasa', 'Kuku', 'Telinga'],
                'points' => 40, // Tambahkan poin
            ],
            'grooming_super' => [
                'price' => 50000,
                'benefits' => ['Mandi + Anti Kutu', 'Kuku', 'Telinga', 'Cukur rapi'],
                'points' => 50, // Tambahkan poin
            ],
            'grooming_max_all' => [
                'price' => 60000,
                'benefits' => ['Mandi + Anti Jamur + Anti Kutu', 'Kuku', 'Telinga', 'Cukur rapi', 'Vitamin bulu', 'Parfum eksklusif'],
                'points' => 60, // Tambahkan poin
            ],
        ],
        'adult' => [
            'grooming_premium' => [
                'price' => 45000,
                'benefits' => ['Mandi biasa', 'Kuku', 'Telinga'],
                'points' => 45, // Tambahkan poin
            ],
            'grooming_super' => [
                'price' => 55000,
                'benefits' => ['Mandi + Anti Kutu', 'Kuku', 'Telinga', 'Cukur rapi'],
                'points' => 55, // Tambahkan poin
            ],
            'grooming_max_all' => [
                'price' => 65000,
                'benefits' => ['Mandi + Anti Jamur + Anti Kutu', 'Kuku', 'Telinga', 'Cukur rapi', 'Vitamin bulu', 'Parfum eksklusif'],
                'points' => 65, // Tambahkan poin
            ],
        ],
    ];


    /**
     * Menampilkan daftar booking grooming (biasanya yang pending).
     */
    public function index(Request $request)
    {
        $query = GroomingBooking::orderBy('created_at', 'desc');

        // Fitur pencarian berdasarkan kode transaksi
        if ($request->has('search') && !empty($request->search)) {
            $query->where('transaction_code', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('customer_name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('customer_phone', 'LIKE', '%' . $request->search . '%');
        }

        $bookings = $query->paginate(10); // Paginate untuk performa

        return view('admin.grooming_bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan form untuk mengedit booking.
     */
    public function edit(GroomingBooking $groomingBooking)
    {
        return view('admin.grooming_bookings.edit', [
            'booking' => $groomingBooking,
            'groomingOptions' => self::GROOMING_OPTIONS,
        ]);
    }

    /**
     * Memperbarui detail booking (termasuk jadwal/waktu).
     */
    public function update(Request $request, GroomingBooking $groomingBooking)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'pet_type' => 'required|in:kitten,adult',
            'grooming_type' => 'required|string',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $originalStatus = $groomingBooking->status; // Simpan status asli sebelum update

        $petType = $request->pet_type;
        $groomingTypeFromRequest = $request->grooming_type; // Ambil string grooming_type dari request

        // Ubah string grooming_type dari request menjadi format key di GROOMING_OPTIONS
        $groomingTypeKey = Str::slug($groomingTypeFromRequest, '_');

        // Dapatkan data grooming spesifik (price dan points)
        $selectedGroomingDetails = self::GROOMING_OPTIONS[$petType][$groomingTypeKey] ?? null;

        if (is_null($selectedGroomingDetails)) {
            return back()->withInput()->with('error', 'Jenis grooming yang dipilih tidak valid.');
        }

        $price = $selectedGroomingDetails['price'];
        $pointsToAward = $selectedGroomingDetails['points']; // Ambil poin dari detail yang ditemukan

        \DB::beginTransaction(); // Tambahkan transaksi database di sini juga!
        try {
            $groomingBooking->update([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'pet_type' => $petType,
                'grooming_type' => $groomingTypeFromRequest,
                'price' => $price,
                'booking_date' => $request->booking_date,
                'booking_time' => $request->booking_time,
                'status' => $request->status,
            ]);

            $pointsToAward = $selectedGroomingDetails['points'] ?? 0; // Poin untuk user yang booking
            $additionalReferralPoints = 0;
            $referralMessage = '';
            
            // Logika pemberian poin
            if ($originalStatus === 'pending' && $groomingBooking->status === 'confirmed') {
                $user = $groomingBooking->user; // Dapatkan user terkait
                if ($user) {
                    $user->points += $pointsToAward; // Poin untuk user yang booking

                    // Cek apakah user ini direferral dan ini adalah transaksi pertamanya yang dikonfirmasi
                    if ($user->referred_by && !$user->first_transaction_awarded) {
                        $referrer = User::where('referral_code', $user->referred_by)->first();
                        if ($referrer) {
                            $additionalReferralPoints = 20; // Poin tambahan untuk user lama
                            $referrer->points += $additionalReferralPoints;
                            $referrer->save();
                            $user->first_transaction_awarded = true; // Tandai sudah diberikan
                            $user->save(); // Simpan perubahan pada user yang direferral
                            $referralMessage = " dan tambahan {$additionalReferralPoints} poin kepada pemberi referral.";
                        }
                    }
                    $user->save(); // Simpan perubahan poin pada user yang booking

                    \DB::commit(); // Commit transaksi
                    return redirect()->route('admin.grooming.index')->with('success', 'Booking dengan Kode Transaksi ' . $groomingBooking->transaction_code . ' berhasil diperbarui dan ' . $pointsToAward . ' poin telah diberikan kepada ' . $user->name . $referralMessage);
                }
            }
            
            \DB::commit(); // Commit transaksi jika tidak ada poin yang diberikan
            return redirect()->route('admin.grooming.index')->with('success', 'Booking dengan Kode Transaksi ' . $groomingBooking->transaction_code . ' berhasil diperbarui!');

        } catch (\Exception $e) {
            \DB::rollback(); // Rollback jika ada error
            \Log::error('Failed to update grooming booking and award points: ' . $e->getMessage(), ['booking_id' => $groomingBooking->id]);
            return back()->with('error', 'Terjadi kesalahan saat memperbarui booking atau memberikan poin.');
        }
    }

    /**
     * Mengkonfirmasi status booking menjadi 'confirmed'.
     */
    public function confirm(GroomingBooking $groomingBooking)
    {
        if ($groomingBooking->status !== 'pending') {
            return back()->with('error', 'Booking ini tidak dalam status "Pending" dan tidak bisa dikonfirmasi.');
        }

        // Pastikan user_id tidak null dan user ada
        $user = $groomingBooking->user;
        if (!$user) {
            return back()->with('error', 'Booking tidak terhubung dengan user yang valid.');
        }

        $petType = $groomingBooking->pet_type;
        $groomingTypeKey = Str::slug($groomingBooking->grooming_type, '_');
        $selectedGroomingDetails = self::GROOMING_OPTIONS[$petType][$groomingTypeKey] ?? null;

        $pointsToAward = $selectedGroomingDetails['points'] ?? 0;
        $additionalReferralPoints = 0;
        $referralMessage = '';

        // Cek apakah user ini direferral dan ini adalah transaksi pertamanya yang dikonfirmasi
        if ($user->referred_by && !$user->first_transaction_awarded) {
            $referrer = User::where('referral_code', $user->referred_by)->first();
            if ($referrer) {
                $additionalReferralPoints = 20; // Poin tambahan untuk user lama
            }
        }

        \DB::beginTransaction();
        try {
            // Ubah status booking
            $groomingBooking->status = 'confirmed';
            $groomingBooking->save();

            // Berikan poin ke user yang booking
            $user->points += $pointsToAward;
            $user->save();

            // Berikan poin tambahan ke referrer jika ada
            if ($additionalReferralPoints > 0 && $referrer) {
                $referrer->points += $additionalReferralPoints;
                $referrer->save();
                $user->first_transaction_awarded = true; // Tandai bahwa poin transaksi pertama sudah diberikan
                $user->save();
                $referralMessage = " dan tambahan {$additionalReferralPoints} poin kepada pemberi referral.";
            }

            \DB::commit();

            return redirect()->route('admin.grooming.index')->with('success', 'Booking dengan Kode Transaksi ' . $groomingBooking->transaction_code . ' berhasil dikonfirmasi. ' . $pointsToAward . ' poin telah diberikan kepada ' . $user->name . $referralMessage);

        } catch (\Exception $e) {
            \DB::rollback();
            \Log::error('Failed to confirm grooming booking and award points: ' . $e->getMessage(), ['booking_id' => $groomingBooking->id]);
            return back()->with('error', 'Terjadi kesalahan saat mengkonfirmasi booking atau memberikan poin.');
        }
    }

    /**
     * Membatalkan status booking menjadi 'cancelled'.
     */
    public function cancel(GroomingBooking $groomingBooking)
    {
        if ($groomingBooking->status === 'claimed') { // Jika sudah terklaim/terkonfirmasi tidak bisa dibatalkan secara langsung
            return back()->with('error', 'Booking ini sudah dikonfirmasi dan tidak bisa dibatalkan.');
        }

        $groomingBooking->status = 'cancelled';
        $groomingBooking->save();

        return redirect()->route('admin.grooming.index')->with('success', 'Booking dengan Kode Transaksi ' . $groomingBooking->transaction_code . ' berhasil dibatalkan!');
    }

    /**
     * Menghapus booking.
     */
    // public function destroy(GroomingBooking $groomingBooking)
    // {
    //     $groomingBooking->delete();
    //     return redirect()->route('admin.grooming.index')->with('success', 'Booking berhasil dihapus!');
    // }
}