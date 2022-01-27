<?php

namespace App\Http\Livewire\Detail;

use App\Http\Services\Repositories\PenjualanRepository;
use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class PenjualanDetailView extends Component
{
    protected $listeners = [
        'showModal'=>'showModal',
        'showDetailInfo'=>'showDetailInfo',
    ];
    public $gudang_id, $user_id, $total_barang, $ppn, $biaya_lain, $keterangan;
    public $customer_id, $jenis_bayar, $tgl_nota, $tgl_tempo, $total_bayar;
    public $idPenjualan, $detailPenjualan, $penjualan;

    protected $penjualanRepo;

    public function render()
    {
        return view('livewire.detail.penjualan-detail-view');
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->penjualanRepo = new PenjualanRepository();
    }

    public function showDetailInfo($id)
    {
        $this->penjualan = Penjualan::query()
            ->where('id', $id)
            ->first();
        $this->detailPenjualan = $this->penjualan->penjualanDetail;
    }

    public function showModal($id)
    {
        $penjualan = Penjualan::where('id', $id)->first();

        $this->idPenjualan = $penjualan ->id;
        $this->customer_id = $penjualan ->customer->nama;
        $this->jenis_bayar = $penjualan ->jenis_bayar;
        $this->tgl_nota = tanggalan_format($penjualan ->tgl_nota);
        $this->tgl_tempo = tanggalan_format($penjualan ->tgl_tempo);
        $this->gudang_id = $penjualan ->gudang->nama;
        $this->total_bayar = $penjualan ->total_bayar;
        $this->keterangan = $penjualan ->keterangan;

        $this->detailPenjualan= $penjualan ->penjualanDetail;
        $this->emit('showDetailModal');
    }

    public function closeModal()
    {
        $this->emit('hideDetailModal');
    }


}
