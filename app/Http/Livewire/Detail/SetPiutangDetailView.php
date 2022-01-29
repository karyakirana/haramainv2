<?php

namespace App\Http\Livewire\Detail;

use App\Http\Services\Repositories\JurnalSetPiutangRepo;
use App\Models\Keuangan\JurnalPenjualan;
use Livewire\Component;

class SetPiutangDetailView extends Component
{
    protected $listeners = [
        'showModal'=>'showModal',
        'showDetailInfo'=>'showDetailInfo',
    ];
    public $user_id, $total_bayar, $keterangan;
    public $customer_id, $tgl_jurnal;
    public $idSetPiutang, $detailPenjualan, $setPiutang;
    protected $repoSetPiutang;

    public function render()
    {
        return view('livewire.detail.set-piutang-detail-view');
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->repoSetPiutang = new JurnalSetPiutangRepo();
    }
    public function showDetailInfo($id)
    {
        $this->setPiutang = JurnalPenjualan::query()
            ->where('id', $id)
            ->first();
        $this->detailPenjualan = $this->setPiutang->jurnalPenjualanDetail;
    }

    public function showModal($id)
    {
        $setPiutang = JurnalPenjualan::where('id', $id)->first();

        $this->idSetPiutang = $setPiutang ->id;
        $this->customer_id = $setPiutang ->customer->nama;
        $this->tgl_jurnal = tanggalan_format($setPiutang ->tgl_jurnal);
        $this->user_id = $setPiutang ->users->nama;
        $this->total_bayar = $setPiutang ->total_bayar;
        $this->keterangan = $setPiutang ->keterangan;

        $this->detailPenjualan= $setPiutang ->penjualanDetail;
        $this->emit('showDetailModal');
    }

    public function closeModal()
    {
        $this->emit('hideDetailModal');
    }
}
