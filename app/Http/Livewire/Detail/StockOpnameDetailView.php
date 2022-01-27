<?php

namespace App\Http\Livewire\Detail;

use App\Models\Stock\StockOpname;
use Livewire\Component;

class StockOpnameDetailView extends Component
{
    protected $listeners = [
        'showModal'=>'showModal',
        'showDetailInfo'=>'showDetailInfo',
    ];

    public $gudang_id, $user_id, $keterangan;
    public $jenis, $tgl_input, $pegawai_id;
    public $idStockOpname, $detailStockOpname, $stockOpname;

    public function render()
    {
        return view('livewire.detail.stock-opname-detail-view');
    }

    public function showDetailInfo($id)
    {
        $this->stockOpname = StockOpname::query()
            ->where('id', $id)
            ->first();
        $this->detailStockOpname = $this->stockOpname->stockOpnameDetail;
    }

    public function showModal($id)
    {
        $stockOpname = StockOpname::where('id', $id)->first();

        $this->idStockOpname = $stockOpname ->id;
        $this->jenis = $stockOpname ->jenis;
        $this->user_id = $stockOpname ->user_id;
        $this->pegawai_id = $stockOpname -> pegawai_id;
        $this->tgl_input = tanggalan_format($stockOpname ->tgl_input);
        $this->gudang_id = $stockOpname ->gudang->nama;
        $this->keterangan = $stockOpname ->keterangan;

        $this->detailStockOpname= $stockOpname ->stockOpnameDetail;
        $this->emit('showDetailModal');
    }

    public function closeModal()
    {
        $this->emit('hideDetailModal');
    }

}
