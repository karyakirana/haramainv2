<?php

namespace App\Http\Livewire\Penjualan;

use App\Http\Services\Repositories\PenjualanReturRepo;
use App\Models\Master\Customer;
use App\Models\Master\Gudang;
use App\Models\Master\Produk;
use App\Models\Penjualan\PenjualanRetur;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReturBaikForm extends Component
{
    public function render()
    {
        return view('livewire.penjualan.retur-baik-form');
    }

    protected $listeners = [
        'setCustomer'=>'setCustomer',
        'setProduk'=>'setProduk'
    ];

    public $dataDetail =[];
    public $update =false;
    public $gudangData;
    public $indexDetail;
    public $mode = 'create';
    public $idRetur;

    // properti master
    public $kode, $customer_id, $customer_nama, $customer_diskon, $gudang_id, $user_id;
    public $tgl_nota, $tgl_tempo, $jenis_retur, $status_bayar, $total_barang, $ppn, $biaya_lain, $total_bayar;
    public $keterangan, $print;
    public $total, $total_rupiah, $total_bayar_rupiah;

    // properti detail
    public $idDetail, $idProduk, $namaProduk, $kodeLokalProduk, $coverProduk, $halProduk, $hargaProduk, $diskonProduk, $jumlahProduk, $subTotalProduk;
    public $detailProduk, $detailHarga, $detailDiskon, $detailDiskonHarga, $detailSubTotal;

    public function mount($retur = null)
    {
        $this->tgl_nota = tanggalan_format(now('ASIA/JAKARTA'));
        $this->tgl_tempo = tanggalan_format(now('ASIA/JAKARTA')->addMonth(2));
        $this->gudangData = Gudang::all();

        // set edit
        if ($retur){
            $this->mode = 'update';
            $retur = PenjualanRetur::query()->with(['customer', 'gudang', 'users', 'returDetail'])->find($retur);
            //dd($retur);
            $this->idRetur = $retur->id;
            $this->customer_id = $retur->customer_id;
            $this->customer_nama = $retur->customer->nama;
            $this->customer_diskon = $retur->customer->diskon;
            $this->jenis_retur = $retur->jenis_retur;
            $this->tgl_nota = tanggalan_format($retur->tgl_nota);
            $this->gudang_id = $retur->gudang_id;
            $this->user_id = $retur->user_id;
            $this->ppn = $retur->ppn;
            $this->biaya_lain = $retur->biaya_lain;
            $this->keterangan = $retur->keterangan;

            foreach ($retur->returDetail as $row)
            {
                $this->dataDetail [] = [
                    'produk_id'=>$row->produk_id,
                    'kode_lokal'=>$row->produk->kode_lokal,
                    'nama_produk'=>$row->produk->nama."\n".$row->produk->cover."\n".$row->produk->hal,
                    'harga'=>$row->harga,
                    'jumlah'=>$row->jumlah,
                    'diskon'=>$row->diskon,
                    'sub_total'=>$row->sub_total
                ];
            }
            $this->hitungTotal();
            $this->hitungTotalBayar();
        }

    }

    public function showCustomer()
    {
        $this->emit('showCustomer');
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer_id = $customer->id;
        $this->customer_nama = $customer->nama;
        $this->customer_diskon = $customer->diskon;
        $this->emit('hideCustomer');
    }

    public function hitungDiskon()
    {
        $this->detailDiskon = (int)$this->hargaProduk - ((int)$this->hargaProduk * ((int)$this->diskonProduk)/100);
        $this->detailDiskonHarga = rupiah_format($this->detailDiskon);
    }

    public function hitungSubTotal()
    {
        $this->hitungDiskon();
        $this->subTotalProduk = $this->detailDiskon * (int)$this->jumlahProduk;
        $this->detailSubTotal = rupiah_format($this->subTotalProduk);
    }

    public function hitungTotal() : void
    {
        $this->total = array_sum(array_column($this->dataDetail, 'sub_total'));
        $this->total_rupiah = rupiah_format($this->total);
    }

    public function hitungTotalBayar() : void
    {
        $this->total_bayar = (int)$this->total + (int)$this->biaya_lain + (int)$this->ppn;
        $this->total_bayar_rupiah = rupiah_format($this->total_bayar);
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
        $this->hargaProduk = $produk->harga;
        $this->diskonProduk = $this->customer_diskon;
        $this->detailHarga = rupiah_format($this->hargaProduk);
        $this->hitungDiskon();
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
            'harga'=>$this->hargaProduk,
            'jumlah'=>$this->jumlahProduk,
            'diskon'=>$this->diskonProduk,
            'sub_total'=>$this->subTotalProduk
        ];

        $this->resetForm();
        $this->hitungTotal();
        $this->hitungTotalBayar();
    }

    protected function resetForm()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset([
            'idProduk', 'namaProduk', 'hargaProduk', 'detailHarga', 'diskonProduk', 'detailDiskonHarga', 'jumlahProduk',
            'subTotalProduk', 'detailSubTotal'
        ]);
    }

    public function editLine($index)
    {
        // edit line transaksi
        $this->update = true;
        $this->indexDetail = $index;
        $this->idProduk = $this->dataDetail[$index]['produk_id'];
        $this->namaProduk = $this->dataDetail[$index]['nama_produk'];
        $this->hargaProduk = $this->dataDetail[$index]['harga'];
        $this->detailHarga = rupiah_format($this->hargaProduk);
        $this->jumlahProduk = $this->dataDetail[$index]['jumlah'];
        $this->diskonProduk = $this->dataDetail[$index]['diskon'];
        $this->subTotalProduk = $this->dataDetail[$index]['sub_total'];
        $this->hitungSubTotal();
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
        $this->dataDetail[$index]['harga'] = $this->hargaProduk;
        $this->dataDetail[$index]['jumlah'] = $this->jumlahProduk;
        $this->dataDetail[$index]['diskon'] = $this->diskonProduk;
        $this->dataDetail[$index]['sub_total'] = $this->subTotalProduk;
        $this->hitungSubTotal();
        $this->resetForm();
        $this->update = false;
        $this->hitungTotal();
        $this->hitungTotalBayar();
    }

    public function removeLine($index)
    {
        // remove line transaksi
        unset($this->dataDetail[$index]);
        $this->dataDetail = array_values($this->dataDetail);
    }

    protected function setDataPenjualan()
    {
        // validation
        $this->validate([
            'customer_id'=>'required',
            'gudang_id'=>'required',
            'jenis_retur'=>'required',
            'tgl_nota'=>'required|date_format:d-M-Y',
        ]);

        $dataDetail = [];
        // set data penjualan detail
        foreach ($this->dataDetail as $index=>$row)
        {
            $dataDetail []= [
                'produk_id'=>$row['produk_id'],
                'harga'=>$row['harga'],
                'jumlah'=>$row['jumlah'],
                'diskon'=>$row['diskon'],
                'sub_total'=>$row['sub_total'],
            ];
        }
        // set data
        return (object)[
            'id_retur'=>$this->idRetur,
            'customer_id'=>$this->customer_id,
            'gudang_id'=>$this->gudang_id,
            'tgl_nota'=>$this->tgl_nota,
            'jenis_retur'=>$this->jenis_retur,
            'total_barang'=>array_sum(array_column($this->dataDetail, 'jumlah')),
            'ppn'=>$this->ppn,
            'biaya_lain'=>$this->biaya_lain,
            'total_bayar'=>$this->total_bayar,
            'keterangan'=>$this->keterangan,
            'detail'=>$dataDetail
        ];
    }

    public function store()
    {
        $dataPenjualan = $this->setDataPenjualan();

        DB::beginTransaction();
        try {
            (new PenjualanReturRepo())->store($dataPenjualan);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            session()->flash('message', $e);
        }
        return redirect()->to('retur/baik');

    }

    public function update()
    {
        // set data
        $dataPenjualan = $this->setDataPenjualan();

        DB::beginTransaction();
        try {
            (new PenjualanReturRepo())->update($dataPenjualan);
            DB::commit();
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            session()->flash('message', $e);
        }
        return redirect()->to('retur/baik');

    }
}
