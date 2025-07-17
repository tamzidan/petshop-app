<?php
// app/Http/Controllers/Admin/SliderController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting untuk mengelola file

class SliderController extends Controller
{
    // Menampilkan semua slider di halaman admin
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    // Menampilkan form untuk menambah slider baru
    public function create()
    {
        return view('admin.sliders.create');
    }

    // Menyimpan slider baru
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Simpan gambar ke storage
        $path = $request->file('image')->store('sliders', 'public');

        // Simpan path ke database
        Slider::create(['image_path' => $path]);

        return redirect()->route('sliders.index')->with('success', 'Gambar slider berhasil ditambahkan.');
    }

    // Menghapus slider
    public function destroy(Slider $slider)
    {
        // Hapus file gambar dari storage
        Storage::disk('public')->delete($slider->image_path);

        // Hapus record dari database
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Gambar slider berhasil dihapus.');
    }
}