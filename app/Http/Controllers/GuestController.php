<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Menampilkan halaman landing page untuk guest.
     */
    public function welcome()
    {
        return view('welcome'); // Ini akan me-render file welcome.blade.php
    }
}