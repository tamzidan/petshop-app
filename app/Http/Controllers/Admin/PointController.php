<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Redemption;
use App\Models\User; // Penting: import model User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointController extends Controller
{
    /**
     * Menampilkan formulir untuk memberikan poin kepada user.
     */
    public function create()
    {
        // Ambil semua user kecuali admin untuk ditampilkan di dropdown atau autocomplete
        $users = User::where('role', 'user')->orderBy('name')->get();
        return view('admin.points.create', compact('users'));
    }

    /**
     * Memproses penambahan/pengurangan poin.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Pastikan user_id ada di tabel users
            'points_amount' => 'required|integer|min:1', // Poin harus bilangan bulat positif
            'action' => 'required|in:add,deduct', // Aksi harus 'add' atau 'deduct'
        ]);

        $user = User::find($request->user_id);

        if ($request->action === 'add') {
            $user->points += $request->points_amount;
            $message = 'Poin berhasil ditambahkan ke ' . $user->name . '.';
        } elseif ($request->action === 'deduct') {
            if ($user->points < $request->points_amount) {
                return back()->withInput()->withErrors(['points_amount' => 'Poin yang akan dikurangi melebihi poin yang dimiliki user.']);
            }
            $user->points -= $request->points_amount;
            $message = 'Poin berhasil dikurangi dari ' . $user->name . '.';
        }

        $user->save();

        return redirect()->route('admin.points.create')->with('success', $message);
    }

    /**
     * Menampilkan daftar semua user dengan poin mereka.
     */
    public function index()
    {
        $users = User::orderBy('name')->get(); // Ambil semua user untuk tampilan daftar
        return view('admin.points.index', compact('users'));
    }





    /**
     * Menampilkan daftar penukaran poin yang 'pending'.
     */
    public function showRedemptions()
    {
        // Ambil semua penukaran yang statusnya 'pending' atau 'claimed' untuk dilihat admin
        $redemptions = Redemption::with(['user', 'product'])
                                ->orderBy('created_at', 'desc')
                                ->get(); // Ambil semua untuk tampilan riwayat admin
        return view('admin.points.redemptions', compact('redemptions'));
    }

    /**
     * Memproses klaim voucher oleh admin berdasarkan kode unik.
     */
    public function claimRedemption(Request $request)
    {
        $request->validate([
            'unique_code' => 'required|string|size:10', // Kode unik harus 10 karakter
        ]);

        $uniqueCode = $request->unique_code;

        // Cari penukaran berdasarkan kode unik
        $redemption = Redemption::where('unique_code', $uniqueCode)->first();

        if (!$redemption) {
            return back()->with('error', 'Kode klaim tidak ditemukan.');
        }

        if ($redemption->status === 'claimed') {
            return back()->with('error', 'Kode klaim ini sudah digunakan sebelumnya.');
        }

        if ($redemption->status === 'cancelled') {
            return back()->with('error', 'Kode klaim ini telah dibatalkan.');
        }

        try {
            DB::beginTransaction();

            // Ubah status penukaran menjadi 'claimed'
            $redemption->status = 'claimed';
            $redemption->claimed_at = now(); // Catat waktu klaim
            $redemption->save();

            DB::commit();

            return redirect()->route('admin.redemptions.index')->with('success', 'Penukaran poin berhasil diklaim untuk produk: ' . $redemption->product->name . ' oleh ' . $redemption->user->name . '.');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Failed to claim redemption: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengklaim penukaran. Silakan coba lagi.');
        }
    }
}