<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelBooking; // Gunakan model HotelBooking
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelBookingController extends Controller
{
    // Ambil konstanta dari controller user-side kita untuk konsistensi
    const PRICE_PER_NIGHT_PER_CAT = 50000;
    const FIRST_TRANSACTION_BONUS_POINTS = 80;
    const POINT_CONVERSION_RATE = 1000;

    /**
     * Menampilkan daftar semua booking hotel.
     */
    public function index(Request $request)
    {
        $query = HotelBooking::with('user')->orderBy('created_at', 'desc');

        // Fitur pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('transaction_code', 'LIKE', '%' . $search . '%')
                  ->orWhere('customer_name', 'LIKE', '%' . $search . '%')
                  ->orWhere('customer_phone', 'LIKE', '%' . $search . '%');
            });
        }

        $bookings = $query->paginate(10);
        return view('admin.hotel_bookings.index', compact('bookings'));
    }

    /**
     * Menampilkan form untuk mengedit booking.
     */
    public function edit(HotelBooking $hotelBooking)
    {
        return view('admin.hotel_bookings.edit', ['booking' => $hotelBooking]);
    }

    /**
     * Memperbarui detail booking.
     */
    public function update(Request $request, HotelBooking $hotelBooking)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'number_of_cats' => 'required|integer|min:1',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $originalStatus = $hotelBooking->status;

        DB::beginTransaction();
        try {
            // Hitung ulang harga jika ada perubahan tanggal atau jumlah kucing
            $checkIn = Carbon::parse($request->check_in_date);
            $checkOut = Carbon::parse($request->check_out_date);
            $durationInNights = $checkIn->diffInDays($checkOut);
            $totalPrice = $durationInNights * $request->number_of_cats * self::PRICE_PER_NIGHT_PER_CAT;

            $hotelBooking->update([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'number_of_cats' => $request->number_of_cats,
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
                'total_price' => $totalPrice,
                'status' => $request->status,
            ]);
            
            // Logika pemberian poin HANYA JIKA status berubah dari 'pending' ke 'confirmed'
            if ($originalStatus === 'pending' && $hotelBooking->status === 'confirmed') {
                $this->processTransactionRewards($hotelBooking->user, $hotelBooking->total_price);
            }
            
            DB::commit();
            return redirect()->route('admin.hotel.index')->with('success', 'Booking hotel berhasil diperbarui!');
            
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Failed to update hotel booking: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memperbarui booking.');
        }
    }

    /**
     * Mengkonfirmasi booking & memberikan poin.
     */
    public function confirm(HotelBooking $hotelBooking)
    {
        if ($hotelBooking->status !== 'pending') {
            return back()->with('error', 'Booking ini tidak dalam status "Pending".');
        }

        DB::beginTransaction();
        try {
            $hotelBooking->status = 'confirmed';
            $hotelBooking->save();
            
            // Panggil fungsi reward yang sama
            $this->processTransactionRewards($hotelBooking->user, $hotelBooking->total_price);
            
            DB::commit();
            return redirect()->route('admin.hotel.index')->with('success', 'Booking berhasil dikonfirmasi dan poin telah diberikan.');
            
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Failed to confirm hotel booking: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengkonfirmasi booking.');
        }
    }

    /**
     * Membatalkan booking.
     */
    public function cancel(HotelBooking $hotelBooking)
    {
        if ($hotelBooking->status === 'completed' || $hotelBooking->status === 'confirmed') {
            return back()->with('error', 'Booking yang sudah selesai atau terkonfirmasi tidak bisa dibatalkan.');
        }

        $hotelBooking->status = 'cancelled';
        $hotelBooking->save();
        return redirect()->route('admin.hotel.index')->with('success', 'Booking berhasil dibatalkan.');
    }

    /**
     * Fungsi terpusat untuk memproses reward poin.
     * Diambil dari controller user-side untuk konsistensi.
     */
    private function processTransactionRewards(?User $user, int $totalPrice)
    {
        if (!$user) {
            return; // Jika booking tidak terhubung ke user, jangan lakukan apa-apa
        }

        $pointsToAdd = 0;

        if (!$user->first_transaction_awarded) {
            $pointsToAdd += self::FIRST_TRANSACTION_BONUS_POINTS;
            $referrer = $user->referrerUser; 
            if ($referrer) {
                $referrer->points += 100; // Poin untuk referrer
                $referrer->save();
            }
            $user->first_transaction_awarded = true;
        }

        $regularPoints = floor($totalPrice / self::POINT_CONVERSION_RATE);
        $pointsToAdd += $regularPoints;

        if ($pointsToAdd > 0) {
            $user->points += $pointsToAdd;
            $user->save();
        }
    }
}