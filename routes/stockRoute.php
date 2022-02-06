<?php

Route::middleware(['auth'])->group(function (){

    // stock masuk
    Route::get('stock/masuk',[\App\Http\Controllers\Stock\StockMasukController::class, 'index'])->name('stockmasuk.index');
    Route::get('stock/masuk/baik', [\App\Http\Controllers\Stock\StockMasukController::class, 'indexBaik'])->name('stockmasuk.baik');
    Route::get('stock/masuk/baik/edit/{id}', [\App\Http\Controllers\Stock\StockMasukController::class, 'editBaik']);
    Route::get('stock/masuk/rusak', [\App\Http\Controllers\Stock\StockMasukController::class, 'indexRusak'])->name('stockmasuk.rusak');
    Route::get('stock/masuk/rusak/edit/{id}', [\App\Http\Controllers\Stock\StockMasukController::class, 'editRusak']);


    // transaksi stock masuk
    Route::get('stock/masuk/baik/trans', [\App\Http\Controllers\Stock\StockMasukController::class, 'createBaik'])->name('stockmasuk.baik.trans');
    Route::get('stock/masuk/rusak/trans', [\App\Http\Controllers\Stock\StockMasukController::class, 'createRusak'])->name('stockmasuk.rusak.trans');

    // stock keluar
    Route::get('stock/keluar', [\App\Http\Controllers\Stock\StockKeluarController::class, 'index'])->name('stockkeluar.index');
    Route::get('stock/keluar/baik', [\App\Http\Controllers\Stock\StockKeluarController::class, 'indexBaik'])->name('stockkeluar.baik');
    Route::get('stock/keluar/baik/edit/{id}', [\App\Http\Controllers\Stock\StockKeluarController::class, 'editBaik']);
    Route::get('stock/keluar/rusak', [\App\Http\Controllers\Stock\StockKeluarController::class, 'indexRusak'])->name('stockkeluar.rusak');
    Route::get('stock/keluar/rusak/edit/{id}', [\App\Http\Controllers\Stock\StockKeluarController::class, 'editRusak']);

    //transaksi stock keluar
    Route::get('stock/keluar/baik/trans', [\App\Http\Controllers\Stock\StockKeluarController::class, 'createBaik'])->name('stockkeluar.baik.trans');
    Route::get('stock/keluar/rusak/trans', [\App\Http\Controllers\Stock\StockKeluarController::class, 'createRusak'])->name('stockkeluar.rusak.trans');

    // Mutasi Stock
    Route::get('stock/mutasi/baik/baik', [\App\Http\Controllers\Stock\StockMutasiController::class, 'indexBaikBaik'])->name('mutasibaik.baik');
    Route::get('stock/mutasi/baik/baik/edit/{id}', [\App\Http\Controllers\Stock\StockMutasiController::class, 'editBaikBaik']);
    Route::get('stock/mutasi/baik/rusak', [\App\Http\Controllers\Stock\StockMutasiController::class, 'indexBaikRusak'])->name('mutasibaik.rusak');
    Route::get('stock/mutasi/baik/rusak/edit/{id}', [\App\Http\Controllers\Stock\StockMutasiController::class, 'editBaikRusak']);
    Route::get('stock/mutasi/rusak/rusak', [\App\Http\Controllers\Stock\StockMutasiController::class, 'indexRusakRusak'])->name('mutasirusak.rusak');
    Route::get('stock/mutasi/rusak/rusak/edit/{id}', [\App\Http\Controllers\Stock\StockMutasiController::class, 'editRusakRusak']);

    // transaksi mutasi stock
    Route::get('stock/mutasi/baik/baik/trans', [\App\Http\Controllers\Stock\StockMutasiController::class, 'createBaikBaik'])->name('mutasibaik.baik.trans');
    Route::get('stock/mutasi/baik/rusak/trans', [\App\Http\Controllers\Stock\StockMutasiController::class, 'createBaikRusak'])->name('mutasibaik.rusak.trans');
    Route::get('stock/mutasi/rusak/rusak/trans', [\App\Http\Controllers\Stock\StockMutasiController::class, 'createRusakRusak'])->name('mutasirusak.rusak.trans');

    // Stock Opname
    Route::get('stock/opname', [\App\Http\Controllers\Stock\StockOpnameController::class, 'index'])->name('stockopname.index');
    Route::get('stock/opname/baik', [\App\Http\Controllers\Stock\StockOpnameController::class, 'indexBaik'])->name('stockopname.baik.index');
    Route::get('stock/opname/baik/edit/{id}', [\App\Http\Controllers\Stock\StockOpnameController::class, 'editBaik']);
    Route::get('stock/opname/rusak', [\App\Http\Controllers\Stock\StockOpnameController::class, 'indexRusak'])->name('stockopname.rusak.index');
    Route::get('stock/opname/rusak/edit/{id}', [\App\Http\Controllers\Stock\StockOpnameController::class, 'editRusak']);

    // transaksi stock opname
    Route::get('stock/opname/baik/trans', [\App\Http\Controllers\Stock\StockOpnameController::class, 'createBaik'])->name('stockopname.baik.trans');
    Route::get('stock/opname/rusak/trans', [\App\Http\Controllers\Stock\StockOpnameController::class, 'createRusak'])->name('stockopname.rusak.trans');


    // stock Inventory
    Route::get('stock/inventory', [\App\Http\Controllers\Stock\StockInventoryController::class, 'index'])->name('stock.inventory.index');
    Route::get('stock/inventory/gudang/{id}', [\App\Http\Controllers\Stock\StockInventoryController::class, 'indexBaik']);
    Route::get('stock/inventory/rusak', [\App\Http\Controllers\Stock\StockInventoryController::class, 'indexRusak']);
});


