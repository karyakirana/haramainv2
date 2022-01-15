<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
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



/**
 * Login and Register
 */
Route::get('/signin', [\App\Http\Controllers\Security\AuthController::class, 'index'])
    ->middleware('guest')
    ->name('login');
Route::post('/signin', [\App\Http\Controllers\Security\AuthController::class, 'login'])->middleware('guest');

Route::get('/signup', [\App\Http\Controllers\Security\AuthController::class, 'create'])->name('register')->middleware('guest');
Route::post('/signup', [\App\Http\Controllers\Security\AuthController::class, 'store'])->middleware('guest');



Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', [\App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');

    Route::get('master/customer', [\App\Http\Controllers\Master\CustomerController::class, 'index'])->name('master.customer');
    Route::patch('master/customer', [\App\Http\Controllers\Master\CustomerController::class, 'datatables']);

    Route::get('master/produk', [\App\Http\Controllers\Master\ProdukController::class, 'index'])->name('master.produk');
    Route::get('master/produk/kategori', [\App\Http\Controllers\Master\ProdukController::class, 'indexKategori'])->name('master.produk.kategori');
    Route::get('master/produk/kategoriharga', [\App\Http\Controllers\Master\ProdukController::class, 'indexKategoriHarga'])->name('master.produk.kategoriharga');

    Route::get('/master/supplier', [\App\Http\Controllers\Master\SupplierController::class, 'index'])->name('master.supplier');
    Route::get('/master/supplier/jenis', [\App\Http\Controllers\Master\SupplierController::class, 'indexJenis'])->name('master.supplier.jenis');

    Route::get('master/gudang', [\App\Http\Controllers\Master\GudangController::class, 'index'])->name('master.gudang');
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

//require __DIR__.'/auth.php';
require __DIR__.'/penjualanRoute.php';

// stock masuk
    Route::get('stock/masuk',[\App\Http\Controllers\Stock\StockMasukController::class, 'index'])->name('stockmasuk.index');
    Route::get('stock/masuk/baik', [\App\Http\Controllers\Stock\StockMasukController::class, 'indexBaik'])->name('stockmasuk.baik');
    Route::get('stock/masuk/rusak', [\App\Http\Controllers\Stock\StockMasukController::class, 'indexRusak'])->name('stockmasuk.rusak');

    // transaksi stock masuk
        Route::get('stock/masuk/baik/trans', [\App\Http\Controllers\Stock\StockMasukController::class, 'createBaik'])->name('stockmasuk.baik.trans');
        Route::get('stock/masuk/rusak/trans', [\App\Http\Controllers\Stock\StockMasukController::class, 'createRusak'])->name('stockmasuk.rusak.trans');

// stock keluar
    Route::get('stock/keluar', [\App\Http\Controllers\Stock\StockKeluarController::class, 'index'])->name('stockkeluar.index');
    Route::get('stock/keluar/baik', [\App\Http\Controllers\Stock\StockKeluarController::class, 'indexBaik'])->name('stockkeluar.baik');
    Route::get('stock/keluar/rusak', [\App\Http\Controllers\Stock\StockKeluarController::class, 'indexRusak'])->name('stockkeluar.rusak');

    //transaksi stock keluar
        Route::get('stock/keluar/baik/trans', [\App\Http\Controllers\Stock\StockKeluarController::class, 'createBaik'])->name('stockkeluar.baik.trans');
        Route::get('stock/keluar/rusak/trans', [\App\Http\Controllers\Stock\StockKeluarController::class, 'createRusak'])->name('stockkeluar.rusak.trans');

// Mutasi Stock
    Route::get('stock/mutasi/baik/baik', [\App\Http\Controllers\Stock\StockMutasiController::class, 'indexBaikBaik'])->name('mutasibaik.baik');
    Route::get('stock/mutasi/baik/rusak', [\App\Http\Controllers\Stock\StockMutasiController::class, 'indexBaikRusak'])->name('mutasibaik.rusak');
    Route::get('stock/mutasi/rusak/rusak', [\App\Http\Controllers\Stock\StockMutasiController::class, 'indexRusakRusak'])->name('mutasirusak.rusak');

    // transaksi mutasi stock
        Route::get('stock/mutasi/baik/baik/trans', [\App\Http\Controllers\Stock\StockMutasiController::class, 'createBaikBaik'])->name('mutasibaik.baik.trans');
        Route::get('stock/mutasi/baik/rusak/trans', [\App\Http\Controllers\Stock\StockMutasiController::class, 'createBaikRusak'])->name('mutasibaik.rusak.trans');
        Route::get('stock/mutasi/rusak/rusak/trans', [\App\Http\Controllers\Stock\StockMutasiController::class, 'createRusakRusak'])->name('mutasirusak.rusak.trans');
