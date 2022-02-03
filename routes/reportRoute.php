<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function (){

    Route::get('penjualan/report', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'rocketMan']);
    Route::get('penjualan/report/print/{start}/{end}', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'rocketManPrint']);

});
