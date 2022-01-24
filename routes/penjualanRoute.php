<?php

use Illuminate\Support\Facades\Route;

/**
 * Penjualan
 */
Route::get('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'index'])->name('penjualan');
Route::post('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'store']);
Route::put('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'update']);
Route::get('penjualan/edit/{id}', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'edit']);
Route::get('penjualan/print/{id}', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'print']);


Route::get('penjualan/new', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'create'])->name('penjualan.create');

Route::get('penjualan/biaya', [\App\Http\Controllers\Penjualan\PenjualanBiayaController::class, 'index'])->name('penjualan.biaya');
Route::get('penjualan/biaya/new', [\App\Http\Controllers\Penjualan\PenjualanBiayaController::class, 'create'])->name('penjualan.biaya.new');
Route::get('penjualan/biaya/edit/{id}', [\App\Http\Controllers\Penjualan\PenjualanBiayaController::class, 'edit']);



/**
 * Retur Baik
 */
Route::get('retur/baik', [\App\Http\Controllers\Penjualan\ReturBaikController::class, 'index'])->name('returbaik');

Route::get('retur/baik/transaksi', [\App\Http\Controllers\Penjualan\ReturBaikController::class, 'create'])->name('returbaik.create');
Route::get('retur/baik/print/{id}', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'print']);


/**
 * Retur Rusak
 */
Route::get('retur/rusak', [\App\Http\Controllers\Penjualan\ReturRusakController::class, 'index'])->name('returrusak');

Route::get('retur/rusak/transaksi', [\App\Http\Controllers\Penjualan\ReturRusakController::class, 'create'])->name('returrusak.create');
