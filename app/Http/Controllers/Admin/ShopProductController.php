<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
use Illuminate\Http\Request;

class ShopProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shopProducts = ShopProduct::all(); // Ambil semua produk dari database
        return view('admin.shop-products.index', compact('shopProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shop-products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
            'price' => 'required|integer|min:0',
            'stock_status' => 'nullable|string',
            'link_tokopedia' => 'nullable|string',
            'link_shopee' => 'nullable|string',
            'link_whatsapp' => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        ShopProduct::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_path' => $imagePath,
            'price' => $request->price,
            'stock_status' => $request->stock_status,
            'link_tokopedia' => $request->link_tokopedia,
            'link_shopee' => $request->link_shopee,
            'link_whatsapp' =>  $request->link_whatsapp,
        ]);

        return redirect()->route('admin.shop-products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
