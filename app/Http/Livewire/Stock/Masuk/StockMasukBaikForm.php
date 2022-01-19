<?php

namespace App\Http\Livewire\Stock\Masuk;

use App\Models\Stock\StockMasuk;
use App\Models\User;
use App\Models\Master\Gudang;
use App\Models\Master\Produk;
use App\Http\Services\Repositories\StockMasukRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StockMasukBaikForm extends Component
{
    protected $listeners = [
        'setProduk'=>'setProduk',
        'setUser'=>'setUser'
    ];

    public $dataDetail =[];
    public $update =false;
    public $gudangData;
    public $indexDetail;
    public $mode = 'create';
    public $idStockMasuk;

    // properti master
    public $kode, $stockable_masuk_id, $stockable_masuk_type, $kondisi;
    public $gudang_id, $tgl_masuk, $user_id, $nomor_po, $keterangan;

    // properti detail
    public $idDetail, $idProduk, $namaProduk, $kodeLokalProduk, $coverProduk, $halProduk;
    public $detailProduk, $jumlahProduk;

    public function mount($stockMasuk = null)
    {
        $this->tgl_masuk = tanggalan_format(now('ASIA/JAKARTA'));
        $this->gudangData = Gudang::all();

        if ($stockMasuk){
            $this->mode = 'update';
            $stockMasuk = StockMasuk::query()->with(['gudang', 'users', 'stockMasukDetail'])->find($stockMasuk);
            $this->idStockMasuk = $stockMasuk ->id;
            $this->stockable_masuk_id = $stockMasuk ->stockable_masuk_id;
            $this->stockable_masuk_type = $stockMasuk ->stockable_masuk_type;
            $this->kondisi = $stockMasuk ->kondisi;
            $this->gudang_id = $stockMasuk->gudang_id;
            $this->user_id = $stockMasuk->user_id;
            $this->tgl_masuk = tanggalan_format($stockMasuk->tgl_masuk);
            $this->nomor_po = $stockMasuk->nomor_po;
            $this->keterangan = $stockMasuk->keterangan;

            foreach ($stockMasuk->stockMasukDetail as $row)
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

    public function showUser()
    {
        $this->emit('showUser');
    }

    public function setUser(User $user)
    {
        $this->user_id = $user->id;
        $this->emit('hideUser');
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


    public function setDataStockMasuk()
    {
        // validation
        $this->validate([
            'gudang_id' => 'required',
            'tgl_masuk' => 'required|date_format:d-M-Y',
        ]);

        $dataDetail = [];
        // set data stock masuk detail
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
            'id_stock_masuk' => $this->idStockMasuk,
            'gudang_id' => $this->gudang_id,
            'stockable_masuk_id' => $this->stockable_masuk_id ?? null,
            'stockable_masuk_type' => $this->stockable_masuk_type ?? null,
            'nomor_po' => $this->nomor_po ,
            'tgl_masuk' => $this->tgl_masuk,
            'kondisi' => 'baik',
            'keterangan' => $this->keterangan,
            'detail' => $dataDetail
        ];
    }
//        dd($dataStockMasuk);
    public function store()
    {
        $dataStockMasuk = $this->setDataStockMasuk();
        DB::beginTransaction();
        try {
            (new StockMasukRepository())->store($dataStockMasuk);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            session()->flash('message', $e);
        }
        return redirect()->to('stock/masuk/baik');

    }

    public function update()
    {
        $dataStockMasuk = $this->setDataStockMasuk();
        DB::beginTransaction();
        try {
            (new StockMasukRepository())->update($dataStockMasuk);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            session()->flash('message', $e);
        }
        return redirect()->to('stock/masuk/baik');

    }


    public function render()
    {
        return view('livewire.stock.masuk.stock-masuk-baik-form');
    }
}
