<?php

use Illuminate\Support\Facades\Route;

/**
 * Penjualan
 */
Route::get('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'index'])->name('penjualan');
Route::patch('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'datatables']);
Route::post('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'store']);
Route::put('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'update']);
Route::get('penjualan/edit/{id}', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'edit']);
