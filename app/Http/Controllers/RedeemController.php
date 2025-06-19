<?php

namespace App\Http\Controllers;

use App\Models\Product; // Import model Product
use App\Models\Redemption; // Import model Redemption
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login
use Illuminate\Support\Str; // Untuk menghasilkan kode unik

class RedeemController extends Controller
{
    // Menampilkan daftar produk yang bisa ditukarkan oleh user
    public function index()
    {
        $products = Product::where('stock', '>', 0)->get(); // Hanya tampilkan produk yang stoknya ada
        $user = Auth::user(); // User yang sedang login
        return view('redeem.index', compact('products', 'user'));
    }

    // Memproses penukaran poin oleh user
    public function redeem(Request $request, Product $product)
    {
        $user = Auth::user();

        // 1. Periksa ketersediaan stok produk
        if ($product->stock <= 0) {
            return back()->with('error', 'Maaf, stok produk ini sudah habis.');
        }

        // 2. Periksa apakah user memiliki poin yang cukup
        if ($user->points < $product->point_cost) {
            return back()->with('error', 'Poin Anda tidak cukup untuk menukarkan produk ini. Anda membutuhkan ' . $product->point_cost . ' poin.');
        }

        // Lakukan penukaran dalam transaksi database untuk memastikan integritas data
        try {
            \DB::beginTransaction();

            // Kurangi poin user
            $user->points -= $product->point_cost;
            $user->save();

            // Kurangi stok produk
            $product->stock -= 1;
            $product->save();

            // Buat kode unik manual
            $uniqueCode = Str::random(10); // Contoh: 10 karakter acak
            // Pastikan kode unik belum ada di database (jarang terjadi tapi bagus untuk safety)
            while (Redemption::where('unique_code', $uniqueCode)->exists()) {
                $uniqueCode = Str::random(10);
            }

            // Buat entri penukaran baru
            Redemption::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'points_used' => $product->point_cost,
                'unique_code' => $uniqueCode,
                'status' => 'pending', // Status awal 'pending'
            ]);

            \DB::commit();

            return redirect()->route('redeem.history')->with('success', 'Selamat! Anda berhasil menukarkan ' . $product->name . '. Silakan catat kode klaim unik Anda: <strong>' . $uniqueCode . '</strong> untuk ditunjukkan kepada admin.');

        } catch (\Exception $e) {
            \DB::rollback();
            // Log the error for debugging
            \Log::error('Redemption failed: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat penukaran. Silakan coba lagi nanti.');
        }
    }

    // Menampilkan riwayat penukaran poin user
    public function history()
    {
        $user = Auth::user();
        $redemptions = $user->redemptions()->with('product')->latest()->get(); // Ambil riwayat penukaran terbaru

        return view('redeem.history', compact('redemptions', 'user'));
    }
}