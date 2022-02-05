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

    Route::get('master/pegawai', [\App\Http\Controllers\Master\PegawaiController::class, 'index'])->name('master.pegawai');

    Route::get('keuangan/master/akun', [\App\Http\Controllers\Keuangan\AkunController::class, 'index'])->name('master.akun');
    Route::get('keuangan/master/akun/kategori', [\App\Http\Controllers\Keuangan\AkunController::class, 'indexKategori'])->name('master.akun.kategori');
    Route::get('keuangan/master/akun/tipe', [\App\Http\Controllers\Keuangan\AkunController::class, 'indexTipe'])->name('master.akun.tipe');

    Route::get('keuangan/neraca', [\App\Http\Controllers\Keuangan\NeracaSaldoController::class, 'index'])->name('neraca.index');
    Route::get('keuangan/neraca/awal', [\App\Http\Controllers\Keuangan\NeracaSaldoController::class, 'neracaSaldoAwal'])->name('neraca.saldo.awal');
    Route::get('keuangan/neraca/akhir', [\App\Http\Controllers\Keuangan\NeracaSaldoController::class, 'neracaSaldoAkhir'])->name('neraca.saldo.akhir');

    Route::get('keuangan/jurnal/penerimaan', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'index'])->name('jurnal.penerimaan.index');
    Route::get('keuangan/jurnal/penerimaan/trans', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'create'])->name('jurnal.penerimaan.trans');
    Route::get('keuangan/jurnal/penerimaan/edit/{id}', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'create']);
    Route::get('keuangan/jurnal/penerimaan/print/{id}', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'rocketMan']);

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

    // tax
    Route::get('tax/perusahaan', [\App\Http\Controllers\Tax\TaxPenjualanController::class, 'masterPerusahaan'])->name('tax.perusahaan');
    Route::get('tax/perusahaan/table', [\App\Http\Controllers\Tax\TaxPenjualanController::class, 'index']);

});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

//require __DIR__.'/auth.php';
require __DIR__.'/penjualanRoute.php';
require __DIR__.'/reportRoute.php';
