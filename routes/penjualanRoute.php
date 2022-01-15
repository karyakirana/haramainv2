<?php

use Illuminate\Support\Facades\Route;

/**
 * Penjualan
 */
Route::get('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'index'])->name('penjualan');
Route::post('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'store']);
Route::put('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'update']);
Route::get('penjualan/edit/{id}', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'edit']);

Route::get('penjualan/new', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'create'])->name('penjualan.create');



/**
 * Retur Baik
 */
Route::get('retur/baik', [\App\Http\Controllers\Penjualan\ReturBaikController::class, 'index'])->name('returbaik');

Route::get('retur/baik/transaksi', [\App\Http\Controllers\Penjualan\ReturBaikController::class, 'create'])->name('returbaik.create');


/**
 * Retur Rusak
 */
Route::get('retur/rusak', [\App\Http\Controllers\Penjualan\ReturRusakController::class, 'index'])->name('returrusak');

Route::get('retur/rusak/transaksi', [\App\Http\Controllers\Penjualan\ReturRusakController::class, 'create'])->name('returrusak.create');
