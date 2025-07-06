<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showShop()
    {
        return view('user.shop.shop');
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
