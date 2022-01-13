<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Datatables Master
 */
Route::patch('customer', [\App\Http\Controllers\Master\CustomerController::class, 'datatables'])->name('datatables.customer');
Route::patch('customer/set', [\App\Http\Controllers\Master\CustomerController::class, 'componentDatatables'])->name('datatables.customer.set');
Route::patch('produk', [\App\Http\Controllers\Master\ProdukController::class, 'datatablesProduk'])->name('datatables.produk');
Route::patch('produk/set', [\App\Http\Controllers\Master\ProdukController::class, 'componentDatatables'])->name('datatables.produk.set');
Route::patch('produk/kategori', [\App\Http\Controllers\Master\ProdukController::class, 'datatablesKategori'])->name('datatables.produk.kategori');
Route::patch('produk/kategoriharga', [\App\Http\Controllers\Master\ProdukController::class, 'datatablesKategoriHarga'])->name('datatables.produk.kategoriharga');
Route::patch('supplier', [\App\Http\Controllers\Master\SupplierController::class, 'datatablesSupplier'])->name('datatables.supplier');
Route::patch('supplier/jenis', [\App\Http\Controllers\Master\SupplierController::class, 'datatablesJenis'])->name('datatables.supplier.jenis');
Route::patch('gudang', [\App\Http\Controllers\Master\GudangController::class, 'datatablesGudang'])->name('datatables.gudang');

/**
 * Datatables Penjualan and retur Penjualan
 */
Route::patch('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'datatables'])->name('datatables.penjualan');
