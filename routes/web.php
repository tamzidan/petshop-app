<?php

use App\Http\Controllers\Admin\GroomingBookingController;
use App\Http\Controllers\Admin\HotelBookingController;
use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Admin\ProductController; // Tambahkan ini di bagian atas
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\GroomingController;
use App\Http\Controllers\GuestController; // Tambahkan ini di bagian atas
use App\Http\Controllers\HotelController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedeemController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;










/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully';
});


Route::get('/', [GuestController::class, 'welcome'])->name('welcome');
Route::get('/layanan/shop', [GuestController::class, 'showShop'])->name('guest.shop');
Route::get('/layanan/grooming', [GuestController::class, 'showGrooming'])->name('guest.grooming');
Route::get('/layanan/clinic', [GuestController::class, 'showClinic'])->name('guest.clinic');
Route::get('/layanan/hotel', [GuestController::class, 'showHotel'])->name('guest.hotel');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// MIDDLEWARE USER
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rute untuk penukaran poin
    Route::get('/redeem', [RedeemController::class, 'index'])->name('redeem.index');
    Route::post('/redeem/{product}', [RedeemController::class, 'redeem'])->name('redeem.redeem');
    Route::get('/redeem/history', [RedeemController::class, 'history'])->name('redeem.history');

    // Rute untuk menampilkan daftar grooming (halaman baru)
    Route::get('/grooming', [GroomingController::class, 'showGroomingOptions'])->name('grooming.index');

    // Rute untuk Booking Grooming - Perbarui rute ini!
    // Tambahkan {petType?} dan {groomingType?} sebagai parameter opsional
    Route::get('/grooming/book/{petType?}/{groomingType?}', [GroomingController::class, 'create'])->name('grooming.book.create');
    Route::post('/grooming/book', [GroomingController::class, 'store'])->name('grooming.book.store');

    // Rute baru untuk riwayat booking grooming user
    Route::get('/grooming/history', [GroomingController::class, 'history'])->name('grooming.history');

    Route::get('/shop', [UserController::class, 'showShop'])->name('user.shop');
    // Route::get('/grooming', [UserController::class, 'showGrooming'])->name('user.grooming');
    Route::get('/clinic', [UserController::class, 'showClinic'])->name('user.clinic');
    // Route::get('/hotel', [UserController::class, 'showHotel'])->name('user.hotel');

    // Rute untuk Booking Hotel Kucing
    Route::get('/hotel', [HotelController::class, 'index'])->name('hotel.index');
    Route::get('/hotel/booking', [HotelController::class, 'create'])->name('hotel.create');
    Route::post('/hotel/booking', [HotelController::class, 'store'])->name('hotel.store');
    Route::get('/hotel/history', [HotelController::class, 'history'])->name('hotel.history');

});

// MIDDLEWARE ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Contoh rute lain untuk admin
    Route::get('/admin/products', function () {
        return "Ini halaman manajemen produk admin.";
    })->name('admin.products');

    Route::resource('admin/products', ProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show', // Meskipun tidak dipakai, ini default resource
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);

    // Rute untuk manajemen poin (admin)
    Route::get('/admin/points/add', [PointController::class, 'create'])->name('admin.points.create');
    Route::post('/admin/points/store', [PointController::class, 'store'])->name('admin.points.store');
    Route::get('/admin/points', [PointController::class, 'index'])->name('admin.points.index');

    // Rute untuk manajemen penukaran (Redemptions / Klaim Voucher)
    Route::get('/admin/redemptions', [PointController::class, 'showRedemptions'])->name('admin.redemptions.index');
    Route::post('/admin/redemptions/claim', [PointController::class, 'claimRedemption'])->name('admin.redemptions.claim');

    // Rute untuk Manajemen Booking Grooming (Admin)
    Route::get('/admin/grooming', [GroomingBookingController::class, 'index'])->name('admin.grooming.index');
    Route::get('/admin/grooming/{groomingBooking}/edit', [GroomingBookingController::class, 'edit'])->name('admin.grooming.edit');
    Route::put('/admin/grooming/{groomingBooking}', [GroomingBookingController::class, 'update'])->name('admin.grooming.update');
    Route::post('/admin/grooming/{groomingBooking}/confirm', [GroomingBookingController::class, 'confirm'])->name('admin.grooming.confirm');
    Route::post('/admin/grooming/{groomingBooking}/cancel', [GroomingBookingController::class, 'cancel'])->name('admin.grooming.cancel');
    // Route::delete('/admin/grooming/{groomingBooking}', [GroomingBookingController::class, 'destroy'])->name('admin.grooming.destroy');

    // RUTE BARU UNTUK MANAJEMEN BOOKING HOTEL
    Route::get('/admin/hotel', [HotelBookingController::class, 'index'])->name('admin.hotel.index');
    Route::get('/admin/hotel/{hotelBooking}/edit', [HotelBookingController::class, 'edit'])->name('admin.hotel.edit');
    Route::put('/admin/hotel/{hotelBooking}', [HotelBookingController::class, 'update'])->name('admin.hotel.update');
    Route::post('/admin/hotel/{hotelBooking}/confirm', [HotelBookingController::class, 'confirm'])->name('admin.hotel.confirm');
    Route::post('/admin/hotel/{hotelBooking}/cancel', [HotelBookingController::class, 'cancel'])->name('admin.hotel.cancel');

    Route::post('/product/index', [GroomingBookingController::class, 'index'])->name('products.index');

    // Rute baru untuk manajemen Produk Toko
    Route::resource('admin/shop-products', \App\Http\Controllers\Admin\ShopProductController::class)->names([
        'index' => 'admin.shop-products.index',
        'create' => 'admin.shop-products.create',
        'store' => 'admin.shop-products.store',
        'edit' => 'admin.shop-products.edit',
        'update' => 'admin.shop-products.update',
        'destroy' => 'admin.shop-products.destroy',
    ]);


    
    Route::resource('sliders', SliderController::class)->only(['index', 'create', 'store', 'destroy']);
});


// Rute untuk Owner
Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
    // Tambahkan rute lain untuk owner di sini jika diperlukan
});

require __DIR__.'/auth.php';
