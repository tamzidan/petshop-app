<?php

use App\Http\Controllers\Admin\PointController;
use App\Http\Controllers\Admin\ProductController; // Tambahkan ini di bagian atas
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedeemController;
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

Route::get('/', function () {
    return view('welcome');
});

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

});

require __DIR__.'/auth.php';
