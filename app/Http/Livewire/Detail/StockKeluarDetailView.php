<?php

namespace App\Http\Livewire\Detail;

use App\Models\Stock\StockKeluar;
use Livewire\Component;

class StockKeluarDetailView extends Component
{


    protected $listeners = [
        'showModal'=>'showModal',
        'showDetailInfo'=>'showDetailInfo',
    ];

    public $gudang_id, $user_id, $keterangan;
    public $kondisi, $tgl_keluar, $supplier_id;
    public $idStockKeluar, $detailStockKeluar, $stockKeluar;

    public function render()
    {
        return view('livewire.detail.stock-keluar-detail-view');
    }
    public function showDetailInfo($id)
    {
        $this->stockKeluar = StockKeluar::query()
            ->where('id', $id)
            ->first();
        $this->detailStockKeluar = $this->stockKeluar->stockKeluarDetail;
    }

    public function showModal($id)
    {
        $stockKeluar = StockKeluar::where('id', $id)->first();

        $this->idStockKeluar = $stockKeluar ->id;
        $this->kondisi = $stockKeluar ->kondisi;
        $this->user_id = $stockKeluar ->user_id;
        $this->supplier_id = $stockKeluar -> supplier_id;
        $this->tgl_Keluar = tanggalan_format($stockKeluar ->tgl_Keluar);
        $this->gudang_id = $stockKeluar ->gudang->nama;
        $this->keterangan = $stockKeluar ->keterangan;

        $this->detailStockKeluar= $stockKeluar ->stockKeluarDetail;
        $this->emit('showDetailModal');
    }

    public function closeModal()
    {
        $this->emit('hideDetailModal');
    }
}
