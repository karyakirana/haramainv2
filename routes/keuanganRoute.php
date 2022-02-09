<?php

Route::middleware(['auth'])->group(function (){

    Route::get('keuangan/master/akun', [\App\Http\Controllers\Keuangan\AkunController::class, 'index'])->name('master.akun');
    Route::get('keuangan/master/akun/kategori', [\App\Http\Controllers\Keuangan\AkunController::class, 'indexKategori'])->name('master.akun.kategori');
    Route::get('keuangan/master/akun/tipe', [\App\Http\Controllers\Keuangan\AkunController::class, 'indexTipe'])->name('master.akun.tipe');

    Route::get('keuangan/neraca', [\App\Http\Controllers\Keuangan\NeracaSaldoController::class, 'index'])->name('neraca.index');
    Route::get('keuangan/neraca/awal', [\App\Http\Controllers\Keuangan\NeracaSaldoController::class, 'neracaSaldoAwal'])->name('neraca.saldo.awal');
    Route::get('keuangan/neraca/akhir', [\App\Http\Controllers\Keuangan\NeracaSaldoController::class, 'neracaSaldoAkhir'])->name('neraca.saldo.akhir');

    Route::get('keuangan/kasir/penerimaan', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'index'])->name('jurnal.penerimaan.index');
    Route::get('keuangan/kasir/penerimaan/trans', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'create'])->name('jurnal.penerimaan.trans');
    Route::get('keuangan/kasir/penerimaan/edit/{id}', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'create']);
    Route::get('keuangan/kasir/penerimaan/print/{id}', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'rocketMan']);

    Route::get('keuangan/jurnal/pengeluaran', [\App\Http\Controllers\Keuangan\JurnalPengeluaranController::class, 'index'])->name('jurnal.pengeluaran.index');

    Route::get('keuangan/jurnal/mutasi', [\App\Http\Controllers\Keuangan\JurnalMutasiController::class, 'index'])->name('jurnal.mutasi.index');

    // dipakai untuk penerimaan
    //    Route::get('keuangan/kasir/pembayaran/cash', [\App\Http\Controllers\Kasir\PembayaranCashController::class, 'index'])->name('pembayaran.cash.index');

    Route::get('keuangan/kasir/penerimaan/lain', [\App\Http\Controllers\Kasir\PenerimaanCashController::class, 'index'])->name('penerimaan.cash.index');
    Route::get('keuangan/kasir/penerimaan/lain/transaksi', [\App\Http\Controllers\Kasir\PenerimaanCashController::class, 'create'])->name('kasir.penerimaan.cash.transaksi');
    Route::get('keuangan/kasir/penerimaan/lain/edit/{id}', [\App\Http\Controllers\Kasir\PenerimaanCashController::class, 'create']);
    Route::get('keuangan/kasir/penerimaan/lain/print/{id}', [\App\Http\Controllers\Kasir\PenerimaanCashController::class, 'rocketMan']);

    Route::get('keuangan/kasir/pembayaran/piutang', [\App\Http\Controllers\Kasir\PembayaranPiutangController::class, 'index'])->name('pembayaran.piutang.index');
    Route::get('keuangan/kasir/piutang/pegawai', [\App\Http\Controllers\Keuangan\PiutangPegawaiController::class, 'index'])->name('piutang.pegawai.index');

    Route::get('keuangan/kasir/pengeluaran', [\App\Http\Controllers\Kasir\PengeluaranController::class, 'index'])->name('kasir.pengeluaran.index');
    Route::get('keuangan/kasir/pengeluaran/trans', [\App\Http\Controllers\Kasir\PengeluaranController::class, 'create'])->name('kasir.pengeluaran.trans');
    Route::get('keuangan/kasir/pengeluaran/edit/{id}', [\App\Http\Controllers\Kasir\PengeluaranController::class, 'create']);
    Route::get('keuangan/kasir/pengeluaran/print/{id}', [\App\Http\Controllers\Kasir\PengeluaranController::class, 'rocketMan']);

    Route::get('keuangan/kasir/set/piutang', [\App\Http\Controllers\Keuangan\JurnalPenjualanController::class, 'indexSet'])->name('set.piutang.index');
    Route::get('keuangan/kasir/set/piutang/transaksi', [\App\Http\Controllers\Keuangan\JurnalPenjualanController::class, 'create'])->name('set.piutang.transaksi');
    Route::get('keuangan/kasir/set/piutang/transaksi/{id}', [\App\Http\Controllers\Keuangan\JurnalPenjualanController::class, 'edit']);

    Route::get('keuangan/kasir/piutang/pegawai/trans', \App\Http\Livewire\Keuangan\JurnalPiutangPegawaiForm::class);
});
