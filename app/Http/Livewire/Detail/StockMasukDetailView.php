<?php

namespace App\Http\Livewire\Detail;

use App\Models\Stock\StockMasuk;
use Livewire\Component;

class StockMasukDetailView extends Component
{
    protected $listeners = [
        'showModal'=>'showModal',
        'showDetailInfo'=>'showDetailInfo',
    ];

    public $gudang_id, $user_id, $keterangan;
    public $kondisi, $tgl_masuk, $supplier_id;
    public $idStockMasuk, $detailStockMasuk, $stockMasuk;

    public function showDetailInfo($id)
    {
        $this->stockMasuk = StockMasuk::query()
            ->where('id', $id)
            ->first();
        $this->detailStockMasuk = $this->stockMasuk->stockMasukDetail;
    }

    public function showModal($id)
    {
        $stockMasuk = StockMasuk::where('id', $id)->first();

        $this->idStockMasuk = $stockMasuk ->id;
        $this->kondisi = $stockMasuk ->kondisi;
        $this->user_id = $stockMasuk ->user_id;
        $this->supplier_id = $stockMasuk -> supplier_id;
        $this->tgl_masuk = tanggalan_format($stockMasuk ->tgl_masuk);
        $this->gudang_id = $stockMasuk ->gudang->nama;
        $this->keterangan = $stockMasuk ->keterangan;

        $this->detailStockMasuk= $stockMasuk ->stockMasukDetail;
        $this->emit('showDetailModal');
    }

    public function closeModal()
    {
        $this->emit('hideDetailModal');
    }

    public function render()
    {
        return view('livewire.detail.stock-masuk-detail-view');
    }
}
