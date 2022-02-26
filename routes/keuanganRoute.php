<?php

Route::middleware(['auth'])->group(function (){

    Route::get('keuangan/master/akun', [\App\Http\Controllers\Keuangan\AkunController::class, 'index'])->name('master.akun');
    Route::get('keuangan/master/akun/kategori', [\App\Http\Controllers\Keuangan\AkunController::class, 'indexKategori'])->name('master.akun.kategori');
    Route::get('keuangan/master/akun/tipe', [\App\Http\Controllers\Keuangan\AkunController::class, 'indexTipe'])->name('master.akun.tipe');

    Route::get('keuangan/neraca', [\App\Http\Controllers\Keuangan\NeracaSaldoController::class, 'index'])->name('neraca.index');
    Route::get('keuangan/neraca/awal', [\App\Http\Controllers\Keuangan\NeracaSaldoController::class, 'neracaSaldoAwal'])->name('neraca.saldo.awal');
    Route::get('keuangan/neraca/akhir', [\App\Http\Controllers\Keuangan\NeracaSaldoController::class, 'neracaSaldoAkhir'])->name('neraca.saldo.akhir');

    Route::get('keuangan/saldo/piutang', [\App\Http\Controllers\Keuangan\SaldoPiutangController::class, 'index'])->name('saldo.piutang.index');

    Route::get('kasir/penerimaan', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'index'])->name('jurnal.penerimaan.index');
    Route::get('kasir/payment/penjualan', \App\Http\Livewire\Keuangan\PaymentPenjualanForm::class)->name('jurnal.penerimaan.trans');
    Route::get('kasir/penerimaan/edit/{id}', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'create']);
    Route::get('kasir/penerimaan/print/{id}', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'rocketMan']);

    Route::get('keuangan/jurnal/pengeluaran', [\App\Http\Controllers\Keuangan\JurnalPengeluaranController::class, 'index'])->name('jurnal.pengeluaran.index');

    Route::get('keuangan/jurnal/mutasi', [\App\Http\Controllers\Keuangan\JurnalMutasiController::class, 'index'])->name('jurnal.mutasi.index');

    // dipakai untuk penerimaan
    //    Route::get('keuangan/kasir/pembayaran/cash', [\App\Http\Controllers\Kasir\PembayaranCashController::class, 'index'])->name('pembayaran.cash.index');

    Route::get('kasir/penerimaan/lain', [\App\Http\Controllers\Kasir\PenerimaanCashController::class, 'index'])->name('penerimaan.cash.index');
    Route::get('kasir/penerimaan/lain/transaksi', [\App\Http\Controllers\Kasir\PenerimaanCashController::class, 'create'])->name('kasir.penerimaan.cash.transaksi');
    Route::get('kasir/penerimaan/lain/edit/{id}', [\App\Http\Controllers\Kasir\PenerimaanCashController::class, 'create']);
    Route::get('kasir/penerimaan/lain/print/{id}', [\App\Http\Controllers\Kasir\PenerimaanCashController::class, 'rocketMan']);

    Route::get('kasir/pembayaran/piutang', [\App\Http\Controllers\Kasir\PembayaranPiutangController::class, 'index'])->name('pembayaran.piutang.index');

    Route::get('kasir/pengeluaran', [\App\Http\Controllers\Kasir\PengeluaranController::class, 'index'])->name('kasir.pengeluaran.index');
    Route::get('kasir/pengeluaran/trans', [\App\Http\Controllers\Kasir\PengeluaranController::class, 'create'])->name('kasir.pengeluaran.trans');
    Route::get('kasir/pengeluaran/edit/{id}', [\App\Http\Controllers\Kasir\PengeluaranController::class, 'create']);
    Route::get('kasir/pengeluaran/print/{id}', [\App\Http\Controllers\Kasir\PengeluaranController::class, 'rocketMan']);

    Route::get('kasir/pembelian', [\App\Http\Controllers\Kasir\KasirPembelianController::class, 'index'])->name('kasir.pembelian.index');
    Route::get('kasir/pembelian/trans', \App\Http\Livewire\Keuangan\KasirPembelianForm::class)->name('kasir.pembelian.trans');
    Route::get('kasir/pembelian/trans/{pembelian}', \App\Http\Livewire\Keuangan\KasirPembelianForm::class)->name('edit.pembelian');

    Route::get('kasir/pembelian/retur/baik', [\App\Http\Controllers\Kasir\ReturPembelianController::class, 'indexBaik'])->name('kasir.retur.baik.pembelian.index');
    Route::get('kasir/pembelian/retur/baik/trans', \App\Http\Livewire\Kasir\ReturBaikPembelianForm::class)->name('kasir.retur.baik.pembelian.trans');
    Route::get('kasir/pembelian/retur/baik/trans/{id}', \App\Http\Livewire\Kasir\ReturBaikPembelianForm::class)->name('edit.retur.rusak.pembelian');

    Route::get('kasir/pembelian/retur/rusak', [\App\Http\Controllers\Kasir\ReturPembelianController::class, 'index'])->name('kasir.retur.rusak.pembelian.index');
    Route::get('kasir/pembelian/retur/rusak/trans', \App\Http\Livewire\Kasir\ReturRusakPembelianForm::class)->name('kasir.retur.rusak.pembelian.trans');
    Route::get('kasir/pembelian/retur/rusak/trans/{id}', \App\Http\Livewire\Kasir\ReturRusakPembelianForm::class)->name('edit.retur.rusak.pembelian');


    Route::get('kasir/set/piutang', [\App\Http\Controllers\Keuangan\JurnalPenjualanController::class, 'indexSet'])->name('set.piutang.index');
    Route::get('kasir/set/piutang/transaksi', [\App\Http\Controllers\Keuangan\JurnalPenjualanController::class, 'create'])->name('set.piutang.transaksi');
    Route::get('kasir/set/piutang/transaksi/{id}', [\App\Http\Controllers\Keuangan\JurnalPenjualanController::class, 'edit']);

    Route::get('kasir/piutang/pegawai/trans', \App\Http\Livewire\Keuangan\JurnalPiutangPegawaiForm::class);
    Route::get('kasir/piutang/pegawai', [\App\Http\Controllers\Keuangan\PiutangPegawaiController::class, 'index'])->name('piutang.pegawai.index');
    Route::get('kasir/piutang/pegawai/trans/{piutang_id}', \App\Http\Livewire\Keuangan\JurnalPiutangPegawaiForm::class);

//    Route::get('kasir/payment/penjualan', \App\Http\Livewire\Keuangan\PaymentPenjualanForm::class);

    // report keuangan
    Route::get('keuangan/report', [\App\Http\Controllers\Keuangan\KeuanganReportController::class, 'index'])->name('keuangan.report');
    Route::get('keuangan/report/cashflow/harian', \App\Http\Livewire\Keuangan\Report\CashFlowHarianForm::class)->name('keuangan.report.cashflow.harian');
});
