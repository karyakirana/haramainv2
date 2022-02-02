<?php

namespace App\Http\Livewire\Stock\Mutasi;

use App\Http\Services\Repositories\StockMutasiRepo;
use App\Models\Master\Gudang;
use App\Models\Master\Produk;
use App\Models\Stock\StockMutasi;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BaikRusakForm extends Component
{
    protected $listeners = [
        'setProduk'=>'setProduk'
    ];

    public $dataDetail =[];
    public $update =false;
    public $gudangData;
    public $indexDetail;
    public $mode = 'create';
    public $idStockMutasi;

    // properti master
    public $kode, $jenis_mutasi, $gudang_asal_id, $gudang_tujuan_id;
    public $tgl_mutasi, $user_id, $keterangan;

    // properti detail
    public $idDetail, $idProduk, $namaProduk, $kodeLokalProduk, $coverProduk, $halProduk;
    public $detailProduk, $jumlahProduk;
    public $gudangAsal, $gudangTujuan;

    public function mount($stockMutasi = null)
    {
        $this->tgl_mutasi = tanggalan_format(now('ASIA/JAKARTA'));
        $gudangData = Gudang::all();
        $this->gudangAsal = $gudangData;
        $this->gudangTujuan = $gudangData;


        if ($stockMutasi){
            $this->mode = 'update';
            $stockMutasi = StockMutasi::query()->with(['gudangAsal', 'gudangTujuan', 'users', 'stockMutasiDetail'])->find($stockMutasi);
            $this->idStockMutasi = $stockMutasi ->id;
            $this->jenis_mutasi = $stockMutasi ->jenis_mutasi;
            $this->gudang_asal_id = $stockMutasi ->gudang_asal_id;
            $this->gudang_tujuan_id = $stockMutasi ->gudang_tujuan_id;
            $this->user_id = $stockMutasi->user_id;
            $this->tgl_mutasi = tanggalan_format($stockMutasi->tgl_mutasi);
            $this->keterangan = $stockMutasi->keterangan;

            foreach ($stockMutasi->stockMutasiDetail as $row)
            {
                $this->dataDetail [] = [
                    'produk_id'=>$row->produk_id,
                    'kode_lokal'=>$row->produk->kode_lokal,
                    'nama_produk'=>$row->produk->nama."\n".$row->produk->cover."\n".$row->produk->hal,
                    'jumlah'=>$row->jumlah,
                ];
            }
        }
    }


    public function showProduk()
    {
        $this->emit('showProduk');
    }


    public function setProduk(Produk $produk)
    {
        $this->idProduk = $produk->id;
        $this->namaProduk = $produk->nama."\n".$produk->cover."\n".$produk->hal;
        $this->kodeLokalProduk = $produk->kode_lokal;
        $this->halProduk = $produk->hal;
        $this->coverProduk = $produk->cover;
        $this->emit('hideProduk');
    }
    public function addLine()
    {
        // add line transaksi
        $this->validate([
            'idProduk'=>'required',
            'jumlahProduk'=>'required'
        ]);

        $this->dataDetail [] = [
            'produk_id'=>$this->idProduk,
            'kode_lokal'=>$this->kodeLokalProduk,
            'nama_produk'=>$this->namaProduk,
            'jumlah'=>$this->jumlahProduk,
        ];

        $this->resetForm();
    }

    protected function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([
            'idProduk', 'namaProduk', 'jumlahProduk'
        ]);
    }

    public function editLine($index)
    {
        // edit line transaksi
        $this->update = true;
        $this->indexDetail = $index;
        $this->idProduk = $this->dataDetail[$index]['produk_id'];
        $this->namaProduk = $this->dataDetail[$index]['nama_produk'];
        $this->jumlahProduk = $this->dataDetail[$index]['jumlah'];
    }

    public function updateLine()
    {
        // update line transaksi
        $this->validate([
            'idProduk'=>'required',
            'jumlahProduk'=>'required'
        ]);
        $index = $this->indexDetail;
        $this->dataDetail[$index]['produk_id'] = $this->idProduk;
        $this->dataDetail[$index]['nama_produk'] = $this->namaProduk;
        $this->dataDetail[$index]['jumlah'] = $this->jumlahProduk;
        $this->resetForm();
        $this->update = false;
    }

    public function removeLine($index)
    {
        // remove line transaksi
        unset($this->dataDetail[$index]);
        $this->dataDetail = array_values($this->dataDetail);
    }


    public function setDataStockMutasi()
    {
        // validation
        $this->validate([
            'gudang_asal_id' => 'required',
            'gudang_tujuan_id' => 'required',
            'tgl_mutasi' => 'required|date_format:d-M-Y',
        ]);

        $dataDetail = [];
        // set data stock Mutasi detail
        foreach ($this->dataDetail as $index => $row) {
            $dataDetail [] = [
                'produk_id' => $row['produk_id'],
                'nama_produk'=> $row['nama_produk'],
                'jumlah' => $row['jumlah'],
            ];
        }
        // set data
        return (object)[
            'active_cash' => session('ClosedCash'),
            'id_stock_mutasi' => $this->idStockMutasi,
            'gudang_asal_id' => $this->gudang_asal_id,
            'gudang_tujuan_id' => $this->gudang_tujuan_id,
            'tgl_mutasi' => $this->tgl_mutasi,
            'jenis_mutasi' => 'baik_rusak',
            'keterangan' => $this->keterangan,
            'detail' => $dataDetail
        ];
    }
//        dd($dataStockMutasi);
    public function store()
    {
        $dataStockMutasi = $this->setDataStockMutasi();
        DB::beginTransaction();
        try {
            (new StockMutasiRepo())->store($dataStockMutasi);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            session()->flash('message', $e);
        }
        return redirect()->to('stock/mutasi/baik/rusak');
    }

    public function update()
    {
        $dataStockMutasi = $this->setDataStockMutasi();
        DB::beginTransaction();
        try {
            (new StockMutasiRepo())->update($dataStockMutasi);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            session()->flash('message', $e);
        }
        return redirect()->to('stock/mutasi/baik/rusak');

    }

    public function render()
    {
        return view('livewire.stock.mutasi.baik-rusak-form');
    }
}
