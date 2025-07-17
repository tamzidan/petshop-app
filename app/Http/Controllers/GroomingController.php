<?php

namespace App\Http\Controllers;

use App\Models\GroomingBooking;
use App\Models\User;
use Carbon\Carbon; // Untuk memanipulasi tanggal dan waktu
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; // Untuk menghasilkan kode unik

class GroomingController extends Controller
{
    // Data harga, jenis, dan keuntungan grooming
    const GROOMING_OPTIONS = [
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

    // SALIN KONSTANTA INI
    const FIRST_TRANSACTION_BONUS_POINTS = 80;
    const POINT_CONVERSION_RATE = 100;


    /**
     * Menampilkan form booking grooming.
     * Menerima parameter opsional petType dan groomingType.
     */
    public function create($petType = null, $groomingType = null)
    {
        return view('grooming.create', [
            'groomingOptions' => self::GROOMING_OPTIONS,
            'selectedPetType' => $petType, // Teruskan ke view
            'selectedGroomingType' => $groomingType, // Teruskan ke view
        ]);
    }

    /**
     * Menyimpan booking grooming baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'pet_type' => 'required|in:kitten,adult',
            'grooming_type' => 'required|string',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
        ]);

        $petType = $request->pet_type;
        $groomingTypeKey = Str::slug($request->grooming_type, '_');
        $price = self::GROOMING_OPTIONS[$petType][$groomingTypeKey]['price'] ?? null;

        if (is_null($price)) {
            return back()->withInput()->with('error', 'Jenis grooming yang dipilih tidak valid.');
        }

        $transactionCode = 'TRX-' . strtoupper(Str::random(6));
        while (GroomingBooking::where('transaction_code', $transactionCode)->exists()) {
            $transactionCode = 'TRX-' . strtoupper(Str::random(6));
        }

        $booking = null;

        // GUNAKAN DB TRANSACTION DI SINI
        DB::transaction(function () use ($request, $transactionCode, $price, $petType, &$booking) {
            $user = Auth::user();

            $booking = GroomingBooking::create([
                'user_id' => $user->id,
                'transaction_code' => $transactionCode,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'pet_type' => $petType,
                'grooming_type' => $request->grooming_type,
                'price' => $price,
                'booking_date' => $request->booking_date,
                'booking_time' => $request->booking_time,
                'status' => 'pending',
            ]);

            // PANGGIL FUNGSI REWARD POIN DI SINI
            // $this->processTransactionRewards($user, $price);
        });

        $whatsappMessage = $this->generateWhatsAppMessage($booking);
        $whatsappAdminNumber = '6285722403823';

        return redirect()->away("https://wa.me/{$whatsappAdminNumber}?text=" . urlencode($whatsappMessage))
                        ->with('success', 'Booking berhasil dibuat! Kode Transaksi Anda: ' . $transactionCode);
    }

    private function processTransactionRewards(User $user, int $totalPrice)
    {
        $pointsToAdd = 0;

        // Cek apakah ini transaksi pertama user (belum pernah dapat bonus)
        if (!$user->first_transaction_awarded) {
            // Berikan bonus transaksi pertama untuk user baru
            $pointsToAdd += self::FIRST_TRANSACTION_BONUS_POINTS;

            // LOGIKA BARU UNTUK REFERRAL
            // Cek apakah user ini punya pengundang (referrer)
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
    private function generateWhatsAppMessage(GroomingBooking $booking)
    {
        $message = "Halo Admin, ada booking grooming baru!\n\n";
        $message .= "Kode Transaksi: *" . $booking->transaction_code . "*\n";
        $message .= "Nama Pelanggan: " . $booking->customer_name . "\n";
        $message .= "No. Telepon: " . $booking->customer_phone . "\n";
        $message .= "Jenis Hewan: " . ucfirst($booking->pet_type) . "\n";
        $message .= "Layanan Grooming: " . $booking->grooming_type . "\n";
        $message .= "Harga: Rp" . number_format($booking->price, 0, ',', '.') . "\n";
        $message .= "Tanggal Booking: " . Carbon::parse($booking->booking_date)->format('d M Y') . "\n";
        $message .= "Jam Booking: " . Carbon::parse($booking->booking_time)->format('H:i') . "\n";
        $message .= "\nMohon segera dikonfirmasi. Terima kasih!";

        return $message;
    }

    /**
     * Menampilkan daftar pilihan grooming dengan detail.
     */
    public function showGroomingOptions()
    {
        return view('grooming.index', [
            'groomingOptions' => self::GROOMING_OPTIONS,
        ]);
    }

    /**
     * Menampilkan riwayat booking grooming untuk user yang sedang login.
     */
    public function history()
    {
        $bookings = Auth::user()->groomingBookings()->orderBy('created_at', 'desc')->paginate(10);
        $groomingOptions = self::GROOMING_OPTIONS; // Kirim data grooming options ke view

        return view('grooming.history', compact('bookings', 'groomingOptions'));
    }

}
