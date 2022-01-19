<?php

namespace App\Http\Livewire\Penjualan;

use App\Models\Keuangan\Akun;
use App\Models\Penjualan\Penjualan;
use Livewire\Component;

class PenjualanBiayaForm extends Component
{
    public $id_penjualan;
    public $customer_id, $customer_nama, $customer_diskon;
    public $jenis_bayar, $tgl_nota, $tgl_tempo, $gudang_id, $gudang_name;
    public $user_id, $user_name, $ppn, $biaya_lain, $keterangan, $total_bayar;
    public $penjualan_detail = [];

    // daftar akun
    public $daftar_akun = [];

    // biaya
    public $biaya, $akun_name, $nominal;
    public $penjualan_biaya = [];
    public $update =false;
    public $mode = 'create';
    public $indexDetail;

    public function mount(Penjualan $penjualan)
    {
        // data penjualan
        $this->id_penjualan = $penjualan->id;
        $this->customer_id = $penjualan->customer_id;
        $this->customer_nama = $penjualan->customer->nama;
        $this->customer_diskon = $penjualan->customer->diskon;
        $this->jenis_bayar = $penjualan->jenis_bayar;
        $this->tgl_nota = tanggalan_format($penjualan->tgl_nota);
        $this->tgl_tempo = $penjualan->tgl_tempo ? tanggalan_format($penjualan->tgl_tempo) : tanggalan_format(strtotime("+2 months", strtotime($penjualan->tgl_nota)));
        $this->gudang_id = $penjualan->gudang_id;
        $this->gudang_name = $penjualan->gudang->nama;
        $this->user_id = $penjualan->user_id;
        $this->user_name = $penjualan->users->name;
        $this->ppn = $penjualan->ppn;
        $this->biaya_lain = $penjualan->biaya_lain;
        $this->total_bayar = $penjualan->total_bayar;
        $this->keterangan = $penjualan->keterangan;

        // penjualan detail
        foreach ($penjualan->penjualanDetail as $row)
        {
            $this->penjualan_detail [] = [
                'produk_id'=>$row->produk_id,
                'kode_lokal'=>$row->produk->kode_lokal,
                'nama_produk'=>$row->produk->nama."\n".$row->produk->cover."\n".$row->produk->hal,
                'harga'=>$row->harga,
                'jumlah'=>$row->jumlah,
                'diskon'=>$row->diskon,
                'sub_total'=>$row->sub_total
            ];
        }
        // penjualan biaya
        foreach ($penjualan->penjualanBiaya as $row)
        {
            $akunBiaya = Akun::find($row->akun_id);
            $this->penjualan_biaya [] = [
                'akun_id'=>$row->akun_id,
                'akun_name'=>$akunBiaya->deskripsi,
                'nominal'=>$row->nominal
            ];
        }

        // daftar akun
        $this->daftar_akun = Akun::query()
            ->where('akun_tipe_id', 5)
            ->get();

        // hitung total bayar
        $this->hitungTotalBayar();
    }

    public function hitungTotalBayar()
    {
        $totalBiaya = array_sum(array_column($this->penjualan_biaya, 'nominal'));
        $this->total_bayar = $this->total_bayar + (int) $totalBiaya;
    }

    public function addLine()
    {
        $this->validate([
            'biaya'=>'required'
        ]);

        $akunBiaya = Akun::find($this->biaya);

        $this->penjualan_biaya [] = [
            'biaya'=>$this->biaya,
            'akun_name'=>$akunBiaya->deskripsi,
            'nominal'=>$this->nominal
        ];
        $this->reset(['biaya', 'nominal']);
        $this->hitungTotalBayar();
    }

    public function editLine($index)
    {
        $this->update = true;
        $this->indexDetail = $index;
        $this->biaya = $this->penjualan_biaya[$index]['biaya'];
        $this->akun_name = $this->penjualan_biaya[$index]['akun_name'];
        $this->nominal = $this->penjualan_biaya[$index]['nominal'];
    }

    public function updateLine()
    {
        $this->validate([
            'biaya'=>'required'
        ]);
        $akunBiaya = Akun::find($this->biaya);

        $index = $this->indexDetail;
        $this->penjualan_biaya[$index]['biaya'] = $this->biaya;
        $this->penjualan_biaya[$index]['akun_name'] = $akunBiaya->deskripsi;
        $this->penjualan_biaya[$index]['nominal'] = $this->nominal;
        $this->reset(['biaya', 'nominal']);
        $this->hitungTotalBayar();
        $this->update = false;
    }

    public function removeLine($index)
    {
        unset($this->penjualan_biaya[$index]);
        $this->penjualan_biaya = array_values($this->penjualan_biaya);
    }

    public function store()
    {
        $penjualan = Penjualan::find($this->id_penjualan);
        foreach ($this->penjualan_biaya as $item)
        {
            $penjualan->penjualanBiaya()->create([
                'akun_id'=>$item['biaya'],
                'nominal'=>$item['nominal']
            ]);
        }
        return redirect()->to('penjualan/biaya');

    }

    public function update()
    {
        $penjualan = Penjualan::find($this->id_penjualan);
        $penjualan->penjualanBiaya()->delete();

        foreach ($this->penjualan_biaya as $item)
        {
            $penjualan->penjualanBiaya()->create([
                'akun_id'=>$item['biaya'],
                'nominal'=>$item['nominal']
            ]);
        }
        return redirect()->to('penjualan/biaya');
    }

    public function render()
    {
        return view('livewire.penjualan.penjualan-biaya-form', [
            'daftarAkun'=>Akun::query()
                ->whereRelation('akunTipe', 'kode', 5)
                ->get()
        ]);
    }
}
