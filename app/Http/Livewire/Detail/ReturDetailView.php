<?php

namespace App\Http\Livewire\Detail;

use App\Models\Penjualan\PenjualanRetur;
use Livewire\Component;

class ReturDetailView extends Component
{
    protected $listeners = [
        'showModal'=>'showModal',
        'showDetailInfo'=>'showDetailInfo',
    ];
    public $gudang_id, $user_id, $total_barang, $ppn, $biaya_lain, $keterangan;
    public $customer_id, $jenis_retur, $tgl_nota, $tgl_tempo, $total_bayar;
    public $idRetur, $detailRetur, $retur;

    public function showDetailInfo($id)
    {
        $this->retur = PenjualanRetur::query()
            ->where('id', $id)
            ->first();
        $this->detailRetur = $this->retur->returDetail;
    }

    public function showModal($id)
    {
        $retur = PenjualanRetur::where('id', $id)->first();

        $this->idRetur = $retur ->id;
        $this->customer_id = $retur ->customer->nama;
        $this->jenis_retur = $retur ->jenis_retur;
        $this->tgl_nota = tanggalan_format($retur ->tgl_nota);
        $this->tgl_tempo = tanggalan_format($retur ->tgl_tempo);
        $this->gudang_id = $retur ->gudang->nama;
        $this->total_bayar = $retur ->total_bayar;
        $this->keterangan = $retur ->keterangan;

        $this->detailRetur= $retur ->returDetail;
        $this->emit('showDetailModal');
    }

    public function closeModal()
    {
        $this->emit('hideDetailModal');
    }

    public function render()
    {
        return view('livewire.detail.retur-detail-view');
    }
}
