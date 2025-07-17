<?php

namespace App\Http\Controllers;

use App\Models\ShopProduct;
use App\Models\Slider;
use Illuminate\Http\Request;

class GuestController extends Controller
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


    /**
     * Menampilkan halaman landing page untuk guest.
     */
    public function welcome()
    {
        $sliders = Slider::all(); // Ambil semua data slider
        return view('welcome', compact('sliders')); // Kirim data ke vie
    }

    public function showShop()
    {
        $shopProducts = ShopProduct::all(); // Ambil semua produk dari tabel shop_products
        return view('guest.shop', compact('shopProducts')); // Kirim data ke view baru
    }
    public function showGrooming()
    {
        return view('guest.grooming', [
            'groomingOptions' => self::GROOMING_OPTIONS,
        ]);
    }
    public function showClinic()
    {
        return view('guest.clinic');
    }
    public function showHotel()
    {
        return view('guest.hotel');
    }

}