<?php

namespace App\Http\Livewire\Detail;

use App\Models\Kasir\ReturPembelian;
use Livewire\Component;

class PembelianReturDetailView extends Component
{
    public function render()
    {
        return view('livewire.detail.pembelian-retur-detail-view');
    }


    protected $listeners = [
        'showModal'=>'showModal',
        'showDetailInfo'=>'showDetailInfo',
    ];
    public $gudang_id, $user_id, $total_barang, $ppn, $biaya_lain, $keterangan;
    public $supplier_id, $jenis_bayar, $tgl_nota, $tgl_tempo, $total_bayar;
    public $idRetur, $detailRetur, $retur;

    public function showDetailInfo($id)
    {
        $this->retur = ReturPembelian::query()
            ->where('id', $id)
            ->first();
        $this->detailRetur = $this->retur->returPembelianDetail;
    }

    public function showModal($id)
    {
        $retur = ReturPembelian::where('id', $id)->first();

        $this->idRetur = $retur ->id;
        $this->supplier_id = $retur ->supplier->nama;
        $this->jenis_bayar = $retur ->jenis_bayar;
        $this->tgl_nota = tanggalan_format($retur ->tgl_nota);
        $this->tgl_tempo = tanggalan_format($retur ->tgl_tempo);
        $this->gudang_id = $retur ->gudang->nama;
        $this->total_bayar = $retur ->total_bayar;
        $this->keterangan = $retur ->keterangan;

        $this->detailRetur= $retur ->returPembelianDetail;
        $this->emit('showDetailModal');
    }

    public function closeModal()
    {
        $this->emit('hideDetailModal');
    }
}
