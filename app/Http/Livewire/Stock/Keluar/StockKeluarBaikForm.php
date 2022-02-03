<?php

namespace App\Http\Livewire\Stock\Keluar;

use App\Http\Services\Repositories\StockKeluarRepository;
use App\Models\Master\Gudang;
use App\Models\Master\Produk;
use App\Models\Master\Supplier;
use App\Models\Stock\StockKeluar;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StockKeluarBaikForm extends Component
{
    protected $listeners = [
        'setProduk'=>'setProduk',
        'setSupplier'=>'setSupplier'
    ];

    public $dataDetail =[];
    public $update =false;
    public $gudangData;
    public $indexDetail;
    public $mode = 'create';
    public $idStockKeluar;


    // properti master
    public $kode, $supplier_id, $supplier_nama, $stockable_keluar_id, $stockable_keluar_type;
    public $kondisi, $gudang_id, $tgl_keluar, $user_id, $keterangan;

    // properti detail
    public $idDetail, $idProduk, $namaProduk, $kodeLokalProduk, $coverProduk, $halProduk;
    public $jumlahProduk;

    public function mount($stockKeluar = null)
    {
        $this->tgl_keluar = tanggalan_format(now('ASIA/JAKARTA'));
        $this->gudangData = Gudang::all();

        if ($stockKeluar){
            $this->mode = 'update';
            $stockKeluar = StockKeluar::query()->with(['gudang', 'users', 'supplier', 'stockKeluarDetail'])->find($stockKeluar);
            $this->idStockKeluar = $stockKeluar ->id;
            $this->supplier_id = $stockKeluar ->supplier_id;
            $this->supplier_nama = $stockKeluar ->supplier->nama ?? '';
            $this->stockable_keluar_id = $stockKeluar ->stockable_keluar_id;
            $this->stockable_keluar_type = $stockKeluar ->stockable_keluar_type;
            $this->kondisi = $stockKeluar ->kondisi;
            $this->gudang_id = $stockKeluar->gudang_id;
            $this->user_id = $stockKeluar->user_id;
            $this->tgl_keluar = tanggalan_format($stockKeluar->tgl_keluar);
            $this->keterangan = $stockKeluar->keterangan;

            foreach ($stockKeluar->stockKeluarDetail as $row)
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

    public function showSupplier()
    {
        $this->emit('showSupplier');
    }

    public function setSupplier(Supplier $supplier)
    {
        $this->supplier_id = $supplier ->id;
        $this->supplier_nama = $supplier->nama;
        $this->emit('hideSupplier');
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
            'supplier_id'=>$this->supplier_id,
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

    public function setDataStockKeluar()
    {
        // validation
        $this->validate([
            'gudang_id' => 'required',
            'tgl_keluar' => 'required|date_format:d-M-Y',
        ]);

        $dataDetail = [];
        // set data stock keluar detail
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
            'id_stock_keluar' => $this->idStockKeluar,
            'gudang_id' => $this->gudang_id,
            'stockable_keluar_id' => $this->stockable_keluar_id ?? null,
            'stockable_keluar_type' => $this->stockable_keluar_type ?? null,
            'supplier_id' => $this->supplier_id ,
            'supplier_nama' => $this->supplier_nama ,
            'tgl_keluar' => $this->tgl_keluar,
            'kondisi' => 'baik',
            'keterangan' => $this->keterangan,
            'detail' => $dataDetail
        ];
    }

    public function store()
    {
//        dd($dataStockKeluar);
        $dataStockKeluar = $this->setDataStockKeluar();

        DB::beginTransaction();
        try {
            (new StockKeluarRepository())->store($dataStockKeluar);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            session()->flash('message', $e);
        }
        return redirect()->to('stock/keluar/baik');

    }

    public function update()
    {
//        dd($dataStockKeluar);
        $dataStockKeluar = $this->setDataStockKeluar();

        DB::beginTransaction();
        try {
            (new StockKeluarRepository())->update($dataStockKeluar);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            session()->flash('message', $e);
        }
        return redirect()->to('stock/keluar/baik');

    }

    public function render()
    {
        return view('livewire.stock.keluar.stock-keluar-baik-form');
    }
}
