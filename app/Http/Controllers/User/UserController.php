<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showShop()
    {
        $shopProducts = ShopProduct::all(); // Ambil semua produk dari database
        return view('user.shop.shop', compact('shopProducts'));
    }
    public function showClinic()
    {
        return view('user.clinic.clinic');
    }
    public function showHotel()
    {
        return view('user.hotel.hotel');
    }
}
