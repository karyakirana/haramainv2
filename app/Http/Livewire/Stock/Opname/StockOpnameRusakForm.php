<?php

namespace App\Http\Livewire\Stock\Opname;

use App\Http\Services\Repositories\StockOpnameRepo;
use App\Models\Master\Gudang;
use App\Models\Master\Pegawai;
use App\Models\Master\Produk;
use App\Models\Stock\StockOpname;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StockOpnameRusakForm extends Component
{
    protected $listeners = [
        'setProduk'=>'setProduk',
        'setPegawai'=>'setPegawai'
    ];

    public $dataDetail =[];
    public $update =false;
    public $gudangData;
    public $indexDetail;
    public $mode = 'create';
    public $idStockOpname;

    // properti master
    public $kode, $jenis, $pegawai_id, $pegawai_nama;
    public $gudang_id, $tgl_input, $user_id, $nomor_po, $keterangan;

    // properti detail
    public $idDetail, $idProduk, $namaProduk, $kodeLokalProduk, $coverProduk, $halProduk;
    public $jumlahProduk;

    public function mount($stockOpname = null)
    {
        $this->tgl_input = tanggalan_format(now('ASIA/JAKARTA'));
        $this->gudangData = Gudang::all();

        if ($stockOpname){
            $this->mode = 'update';
            $stockOpname = StockOpname::query()->with(['gudang', 'users', 'stockOpnameDetail'])->find($stockOpname);
            $this->idStockOpname = $stockOpname ->id;
            $this->jenis = $stockOpname ->jenis;
            $this->pegawai_id = $stockOpname ->pegawai_id;
            $this->pegawai_nama = $stockOpname ->pegawai_nama;
            $this->gudang_id = $stockOpname->gudang_id;
            $this->user_id = $stockOpname->user_id;
            $this->tgl_input = tanggalan_format($stockOpname->tgl_input);
            $this->nomor_po = $stockOpname->nomor_po;
            $this->keterangan = $stockOpname->keterangan;

            foreach ($stockOpname->stockOpnameDetail as $row)
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

    public function showPegawai()
    {
        $this->emit('showPegawai');
    }

    public function setPegawai(Pegawai $pegawai)
    {
        $this->pegawai_id = $pegawai ->id;
        $this->pegawai_nama = $pegawai->nama;
        $this->emit('hidePegawai');
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
        $this->dataDetail[$index]['jenis'] = 'rusak';
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


    public function setDataStockOpname()
    {
        // validation
        $this->validate([
            'gudang_id' => 'required',
            'tgl_input' => 'required|date_format:d-M-Y',
        ]);

        $dataDetail = [];
        // set data stock opname detail
        foreach ($this->dataDetail as $index => $row) {
            $dataDetail [] = [
                'produk_id' => $row['produk_id'],
                'jumlah' => $row['jumlah'],
            ];
        }
        // set data
        return (object)[
            'active_cash' => session('ClosedCash'),
            'id_stock_opname' => $this->idStockOpname,
            'pegawai_id' => $this->pegawai_id,
            'pegawai_nama' => $this->pegawai_nama,
            'gudang_id' => $this->gudang_id,
            'user_id' => $this->user_id,
            'tgl_input' => $this->tgl_input,
            'jenis' => 'rusak',
            'keterangan' => $this->keterangan,
            'detail' => $dataDetail
        ];
    }
//        dd($dataStockOpname);
    public function store()
    {
        $dataStockOpname = $this->setDataStockOpname();
        DB::beginTransaction();
        try {
            (new StockOpnameRepo())->store($dataStockOpname);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            session()->flash('message', $e);
        }
        return redirect()->to('stock/opname/rusak');

    }

    public function update()
    {
        $dataStockOpname = $this->setDataStockOpname();
        DB::beginTransaction();
        try {
            (new StockOpnameRepo())->update($dataStockOpname);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            session()->flash('message', $e);
        }
        return redirect()->to('stock/opname/rusak');

    }

    public function render()
    {
        return view('livewire.stock.opname.stock-opname-rusak-form');
    }
}
