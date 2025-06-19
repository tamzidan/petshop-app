<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Penting: import model User
use Illuminate\Http\Request;

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
}