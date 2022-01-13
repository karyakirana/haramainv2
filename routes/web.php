<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [\App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');

/**
 * Login and Register
 */
Route::get('/signin', [\App\Http\Controllers\Security\AuthController::class, 'index'])
    ->middleware('guest')
    ->name('login');
Route::post('/signin', [\App\Http\Controllers\Security\AuthController::class, 'login'])->middleware('guest');

Route::get('/signup', [\App\Http\Controllers\Security\AuthController::class, 'create'])->name('register')->middleware('guest');
Route::post('/signup', [\App\Http\Controllers\Security\AuthController::class, 'store'])->middleware('guest');

Route::get('master/customer', [\App\Http\Controllers\Master\CustomerController::class, 'index'])->name('master.customer');
Route::patch('master/customer', [\App\Http\Controllers\Master\CustomerController::class, 'datatables']);

Route::get('master/produk', [\App\Http\Controllers\Master\ProdukController::class, 'index'])->name('master.produk');
Route::get('master/produk/kategori', [\App\Http\Controllers\Master\ProdukController::class, 'indexKategori'])->name('master.produk.kategori');
Route::get('master/produk/kategoriharga', [\App\Http\Controllers\Master\ProdukController::class, 'indexKategoriHarga'])->name('master.produk.kategoriharga');

Route::get('/master/supplier', [\App\Http\Controllers\Master\SupplierController::class, 'index'])->name('master.supplier');
Route::get('/master/supplier/jenis', [\App\Http\Controllers\Master\SupplierController::class, 'indexJenis'])->name('master.supplier.jenis');
//require __DIR__.'/auth.php';
require __DIR__.'/penjualanRoute.php';
