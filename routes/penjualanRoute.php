<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function(){

    /**
     * Penjualan
     */
    Route::get('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'index'])->name('penjualan');
    Route::post('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'store']);
    Route::put('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'update']);
    Route::get('penjualan/edit/{id}', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'edit'])->name('edit.penjualan');
    Route::get('penjualan/print/{id}', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'print'])->name('print.penjualan');


    Route::get('penjualan/new', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'create'])->name('penjualan.create');

    Route::get('penjualan/biaya', [\App\Http\Controllers\Penjualan\PenjualanBiayaController::class, 'index'])->name('penjualan.biaya');
    Route::get('penjualan/biaya/new', [\App\Http\Controllers\Penjualan\PenjualanBiayaController::class, 'create'])->name('penjualan.biaya.new');
    Route::get('penjualan/biaya/edit/{id}', [\App\Http\Controllers\Penjualan\PenjualanBiayaController::class, 'edit']);

    Route::get('penjualan/detail/{id}', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'detail'])->name('penjualan.detail');

    /**
     * Retur Baik
     */
    Route::get('retur/baik', [\App\Http\Controllers\Penjualan\ReturBaikController::class, 'index'])->name('returbaik');
    Route::get('retur/baik/edit/{id}', [\App\Http\Controllers\Penjualan\ReturBaikController::class, 'edit'])->name('retur.baik.edit');
    Route::get('retur/baik/transaksi', [\App\Http\Controllers\Penjualan\ReturBaikController::class, 'create'])->name('returbaik.create');


    Route::get('retur/print/{id}', [\App\Http\Controllers\Penjualan\ReturBaikController::class, 'print']);


    /**
     * Retur Rusak
     */
    Route::get('retur/rusak', [\App\Http\Controllers\Penjualan\ReturRusakController::class, 'index'])->name('returrusak');
    Route::get('retur/rusak/edit/{id}', [\App\Http\Controllers\Penjualan\ReturRusakController::class, 'edit'])->name('retur.rusak.edit');
    Route::get('retur/rusak/transaksi', [\App\Http\Controllers\Penjualan\ReturRusakController::class, 'create'])->name('returrusak.create');
});


