<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelBooking;
use App\Models\User; // Penting untuk memproses poin
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; // Untuk database transaction

class HotelController extends Controller
{

        // Data harga, jenis, dan keuntungan grooming
    const HOTEL_OPTIONS = [
        'kitten' => [
            'grooming_premium' => [
                'price' => 40000,
                'benefits' => [
                    'Mandi biasa',
                    'Kuku',
                    'Telinga',
                    // Tambahkan keuntungan spesifik lainnya
                ],
            ],
            'grooming_super' => [
                'price' => 50000,
                'benefits' => [
                    'Mandi + Anti Kutu',
                    'Kuku',
                    'Telinga',
                    'Cukur rapi',
                    // Tambahkan keuntungan spesifik lainnya
                ],
            ],
            'grooming_max_all' => [
                'price' => 60000,
                'benefits' => [
                    'Mandi + Anti Jamur + Anti Kutu',
                    'Kuku',
                    'Telinga',
                    'Cukur rapi',
                    'Vitamin bulu',
                    'Parfum eksklusif',
                    // Tambahkan keuntungan spesifik lainnya
                ],
            ],
        ],
        'adult' => [
            'grooming_premium' => [
                'price' => 45000, // Harga diubah sesuai gambar yang kamu berikan
                'benefits' => [
                    'Mandi biasa',
                    'Kuku',
                    'Telinga',
                    // Tambahkan keuntungan spesifik lainnya
                ],
            ],
            'grooming_super' => [
                'price' => 55000, // Harga diubah sesuai gambar yang kamu berikan
                'benefits' => [
                    'Mandi + Anti Kutu',
                    'Kuku',
                    'Telinga',
                    'Cukur rapi',
                    // Tambahkan keuntungan spesifik lainnya
                ],
            ],
            'grooming_max_all' => [
                'price' => 65000, // Harga diubah sesuai gambar yang kamu berikan
                'benefits' => [
                    'Mandi + Anti Jamur + Anti Kutu',
                    'Kuku',
                    'Telinga',
                    'Cukur rapi',
                    'Vitamin bulu',
                    'Parfum eksklusif',
                    // Tambahkan keuntungan spesifik lainnya
                ],
            ],
        ],
    ];

    // Asumsi harga per malam per kucing. Anda bisa ubah ini.
    const PRICE_PER_NIGHT_PER_CAT = 50000;
    // Asumsi poin bonus untuk transaksi pertama. Anda bisa ubah ini.
    const FIRST_TRANSACTION_BONUS_POINTS = 80;
    // Asumsi rasio konversi poin dari total harga. Anda bisa ubah ini.
    const POINT_CONVERSION_RATE = 100; // 1 poin per Rp 10.000

    public function index()
    {
        return view('hotel.index', [
            'hotelOptions' => self::HOTEL_OPTIONS,
        ]);
    }

    /**
     * Menampilkan form untuk membuat booking hotel baru.
     */
    public function create()
    {
        return view('hotel.create'); // Kita akan buat view ini nanti
    }

    /**
     * Menyimpan data booking hotel baru dan memproses reward poin.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'number_of_cats' => 'required|integer|min:1',
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        // Hitung durasi menginap dan total harga
        $checkIn = Carbon::parse($request->check_in_date);
        $checkOut = Carbon::parse($request->check_out_date);
        $durationInNights = $checkIn->diffInDays($checkOut);
        $totalPrice = $durationInNights * $request->number_of_cats * self::PRICE_PER_NIGHT_PER_CAT;
        
        // Buat kode transaksi unik
        $transactionCode = 'TRX-HOTEL-' . strtoupper(Str::random(6));
        while (HotelBooking::where('transaction_code', $transactionCode)->exists()) {
            $transactionCode = 'TRX-HOTEL-' . strtoupper(Str::random(6));
        }

        $booking = null;

        DB::transaction(function () use ($request, $transactionCode, $totalPrice, &$booking) {
            $user = Auth::user();
            
            // Buat booking hotel
            $booking = HotelBooking::create([
                'user_id' => $user->id,
                'transaction_code' => $transactionCode,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'number_of_cats' => $request->number_of_cats,
                'check_in_date' => $request->check_in_date,
                'check_out_date' => $request->check_out_date,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            // Panggil fungsi untuk memproses reward poin
            // $this->processTransactionRewards($user, $totalPrice);
        });

        // Generate pesan WhatsApp dan redirect
        $whatsappMessage = $this->generateWhatsAppMessage($booking);
        $whatsappAdminNumber = '6285722403823'; // Ganti dengan nomor Admin Anda

        return redirect()->away("https://wa.me/{$whatsappAdminNumber}?text=" . urlencode($whatsappMessage))
                         ->with('success', 'Booking hotel berhasil dibuat! Kode Transaksi Anda: ' . $transactionCode);
    }

    /**
     * Fungsi terpusat untuk memproses reward poin.
     */
private function processTransactionRewards(User $user, int $totalPrice)
{
    $pointsToAdd = 0;

    // Cek apakah ini transaksi pertama user (belum pernah dapat bonus)
    if (!$user->first_transaction_awarded) {
        // Berikan bonus transaksi pertama untuk user baru
        $pointsToAdd += self::FIRST_TRANSACTION_BONUS_POINTS;

        // LOGIKA BARU UNTUK REFERRAL
        // Cek apakah user ini punya pengundang (referrer)
        // Kita menggunakan relasi 'referrerUser' yang sudah Anda buat di model User
        $referrer = $user->referrerUser; 
        
        if ($referrer) {
            // Jika ada, tambahkan 100 poin ke referrer
            $referrer->points += 100; // Poin untuk si pengundang
            $referrer->save();
        }

        // Tandai bahwa bonus transaksi pertama sudah diberikan ke user ini
        $user->first_transaction_awarded = true;
    }

    // Hitung poin reguler dari total harga (tetap berjalan untuk setiap transaksi)
    $regularPoints = floor($totalPrice / self::POINT_CONVERSION_RATE);
    $pointsToAdd += $regularPoints;

    // Tambahkan total poin yang dihitung ke user yang bertransaksi
    if ($pointsToAdd > 0) {
        $user->points += $pointsToAdd;
        $user->save();
    }
}
    /**
     * Generate pesan WhatsApp untuk admin.
     */
    private function generateWhatsAppMessage(HotelBooking $booking)
    {
        $message  = "Halo Admin, ada booking hotel kucing baru!\n\n";
        $message .= "Kode Transaksi: *" . $booking->transaction_code . "*\n";
        $message .= "Nama Pelanggan: " . $booking->customer_name . "\n";
        $message .= "No. Telepon: " . $booking->customer_phone . "\n";
        $message .= "Jumlah Kucing: " . $booking->number_of_cats . "\n";
        $message .= "Check-in: " . $booking->check_in_date->format('d M Y') . "\n";
        $message .= "Check-out: " . $booking->check_out_date->format('d M Y') . "\n";
        $message .= "Total Harga: Rp" . number_format($booking->total_price, 0, ',', '.') . "\n";
        $message .= "\nMohon segera dikonfirmasi. Terima kasih!";

        return $message;
    }

    /**
     * Menampilkan riwayat booking hotel untuk user yang login.
     */
    public function history()
    {
        $bookings = Auth::user()->HotelBookings()->orderBy('created_at', 'desc')->paginate(10);
        return view('hotel.history', compact('bookings')); // Kita akan buat view ini nanti
    }
}