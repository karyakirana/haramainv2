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
Route::patch('supplier/set', [\App\Http\Controllers\Master\SupplierController::class, 'componentDatatables'])->name('datatables.supplier.set');
Route::patch('gudang', [\App\Http\Controllers\Master\GudangController::class, 'datatablesGudang'])->name('datatables.gudang');
Route::patch('pegawai', [\App\Http\Controllers\Master\PegawaiController::class, 'datatables'])->name('datatables.pegawai');
Route::patch('pegawai/set', [\App\Http\Controllers\Master\PegawaiController::class, 'componentDatatables'])->name('datatables.pegawai.set');

Route::patch('akun', [\App\Http\Controllers\Keuangan\AkunController::class, 'datatablesAkun'])->name('datatables.akun');
Route::patch('akun/kategori', [\App\Http\Controllers\Keuangan\AkunController::class, 'datatablesKategori'])->name('datatables.akun.kategori');
Route::patch('akun/tipe', [\App\Http\Controllers\Keuangan\AkunController::class, 'datatablesTipe'])->name('datatables.akun.tipe');

/**
 * Datatables Penjualan and retur Penjualan
 */
Route::patch('penjualan', [\App\Http\Controllers\Penjualan\PenjualanController::class, 'datatables'])->name('datatables.penjualan');
Route::patch('retur/baik', [\App\Http\Controllers\Penjualan\ReturBaikController::class, 'datatables'])->name('datatables.penjualan.retur.baik');
Route::patch('retur/rusak', [\App\Http\Controllers\Penjualan\ReturRusakController::class, 'datatables'])->name('datatables.penjualan.retur.rusak');

Route::patch('penjualan/biaya', [\App\Http\Controllers\Penjualan\PenjualanBiayaController::class, 'datatables'])->name('datatables.penjualan.biaya');


/**
 * Datatables Stock Masuk
 */
Route::patch('stock/masuk', [\App\Http\Controllers\Stock\StockMasukController::class, 'datatablesIndex'])->name('datatables.stockmasuk');
Route::patch('stock/masuk/baik', [\App\Http\Controllers\Stock\StockMasukController::class, 'datatablesIndexBaik'])->name('datatables.stockmasuk.baik');
Route::patch('stock/masuk/rusak', [\App\Http\Controllers\Stock\StockMasukController::class, 'datatablesIndexRusak'])->name('datatables.stockmasuk.rusak');

// Inventory
Route::patch('stock/inventory', [\App\Http\Controllers\Stock\StockInventoryController::class, 'datatablesIndex'])->name('datatables.stock.inventory');
/**
 * Datatables Stock Keluar
 */
Route::patch('stock/keluar', [\App\Http\Controllers\Stock\StockKeluarController::class, 'datatablesIndex'])->name('datatables.stock.keluar');
Route::patch('stock/keluar/baik', [\App\Http\Controllers\Stock\StockKeluarController::class, 'datatablesIndexBaik'])->name('datatables.stock.keluar.baik');
Route::patch('stock/keluar/rusak', [\App\Http\Controllers\Stock\StockKeluarController::class, 'datatablesIndexRusak'])->name('datatables.stock.keluar.rusak');

/**
 * Datatables Stock Mutasi
 */
Route::patch('stock/mutasi/baik/baik', [\App\Http\Controllers\Stock\StockMutasiController::class, 'datatablesBaikBaik'])->name('datatables.mutasi.baik.baik');
Route::patch('stock/mutasi/baik/rusak', [\App\Http\Controllers\Stock\StockMutasiController::class, 'datatablesBaikRusak'])->name('datatables.mutasi.baik.rusak');
Route::patch('stock/mutasi/rusak/rusak', [\App\Http\Controllers\Stock\StockMutasiController::class, 'datatablesRusakRusak'])->name('datatables.mutasi.rusak.rusak');

/**
 * Datatables Stock Opname
 */
Route::patch('stock/opname', [\App\Http\Controllers\Stock\StockOpnameController::class, 'datatablesIndex'])->name('datatables.stockopname');
Route::patch('stock/opname/baik', [\App\Http\Controllers\Stock\StockOpnameController::class, 'datatablesBaik'])->name('datatables.stockopname.baik');
Route::patch('stock/opname/rusak', [\App\Http\Controllers\Stock\StockOpnameController::class, 'datatablesRusak'])->name('datatables.stockopname.rusak');


/**
 * Datatables Keuangan
 */
Route::patch('keuangan/neraca/awal', [\App\Http\Controllers\Keuangan\NeracaSaldoController::class, 'datatablesNeracaSaldoAwal'])->name('datatables.neraca.saldo.awal');

Route::patch('keuangan/jurnal/penerimaan', [\App\Http\Controllers\Keuangan\JurnalPenerimaanController::class, 'datatablesPenerimaan'])->name('datatables.jurnal.penerimaan');
Route::patch('keuangan/jurnal/pengeluaran', [\App\Http\Controllers\Keuangan\JurnalPengeluaranController::class, 'datatablesPengeluaran'])->name('datatables.jurnal.pengeluaran');

Route::patch('keuangan/kasir/penerimaan/cash', [\App\Http\Controllers\Kasir\PenerimaanCashController::class, 'datatablesPenerimaanCash'])->name('datatables.penerimaan.cash');

Route::patch('keuangan/kasir/set/piutang', [\App\Http\Controllers\Keuangan\JurnalPenjualanController::class, 'datatablesSetPiutang'])->name('datatables.set.piutang');
