<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroomingBooking; // Import model GroomingBooking
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
            ],
            'grooming_super' => [
                'price' => 50000,
                'benefits' => ['Mandi + Anti Kutu', 'Kuku', 'Telinga', 'Cukur rapi'],
            ],
            'grooming_max_all' => [
                'price' => 60000,
                'benefits' => ['Mandi + Anti Jamur + Anti Kutu', 'Kuku', 'Telinga', 'Cukur rapi', 'Vitamin bulu', 'Parfum eksklusif'],
            ],
        ],
        'adult' => [
            'grooming_premium' => [
                'price' => 45000,
                'benefits' => ['Mandi biasa', 'Kuku', 'Telinga'],
            ],
            'grooming_super' => [
                'price' => 55000,
                'benefits' => ['Mandi + Anti Kutu', 'Kuku', 'Telinga', 'Cukur rapi'],
            ],
            'grooming_max_all' => [
                'price' => 65000,
                'benefits' => ['Mandi + Anti Jamur + Anti Kutu', 'Kuku', 'Telinga', 'Cukur rapi', 'Vitamin bulu', 'Parfum eksklusif'],
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
            'booking_date' => 'required|date|after_or_equal:today', // Admin bisa reschedule ke tanggal yang sama atau depan
            'booking_time' => 'required|date_format:H:i',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $petType = $request->pet_type;
        $groomingTypeKey = Str::slug($request->grooming_type, '_');
        $price = self::GROOMING_OPTIONS[$petType][$groomingTypeKey]['price'] ?? null;

        if (is_null($price)) {
            return back()->withInput()->with('error', 'Jenis grooming yang dipilih tidak valid.');
        }

        $groomingBooking->update([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'pet_type' => $petType,
            'grooming_type' => $request->grooming_type,
            'price' => $price, // Update harga jika jenis grooming berubah
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.grooming.index')->with('success', 'Booking dengan Kode Transaksi ' . $groomingBooking->transaction_code . ' berhasil diperbarui!');
    }

    /**
     * Mengkonfirmasi status booking menjadi 'confirmed'.
     */
    public function confirm(GroomingBooking $groomingBooking)
    {
        if ($groomingBooking->status !== 'pending') {
            return back()->with('error', 'Booking ini tidak dalam status "Pending" dan tidak bisa dikonfirmasi.');
        }

        $groomingBooking->status = 'confirmed';
        $groomingBooking->save();

        return redirect()->route('admin.grooming.index')->with('success', 'Booking dengan Kode Transaksi ' . $groomingBooking->transaction_code . ' berhasil dikonfirmasi!');
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