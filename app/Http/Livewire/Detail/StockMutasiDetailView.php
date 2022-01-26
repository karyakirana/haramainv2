<?php

namespace App\Http\Livewire\Detail;

use App\Models\Stock\StockMutasi;
use Livewire\Component;

class StockMutasiDetailView extends Component
{
    protected $listeners = [
        'showModal'=>'showModal',
        'showDetailInfo'=>'showDetailInfo',
    ];

    public $gudang_asal_id,$gudang_tujuan_id, $user_id, $keterangan;
    public $jenis_mutasi, $tgl_mutasi;
    public $idStockMutasi, $detailStockMutasi, $stockMutasi;

    public function render()
    {
        return view('livewire.detail.stock-mutasi-detail-view');
    }

    public function showDetailInfo($id)
    {
        $this->stockMutasi = StockMutasi::query()
            ->where('id', $id)
            ->first();
        $this->detailStockMutasi = $this->stockMutasi->stockMutasiDetail;
    }

    public function showModal($id)
    {
        $stockMutasi = StockMutasi::where('id', $id)->first();

        $this->idStockMutasi = $stockMutasi ->id;
        $this->jenis_mutasi = $stockMutasi ->jenis_mutasi;
        $this->user_id = $stockMutasi ->user_id;
        $this->tgl_mutasi = tanggalan_format($stockMutasi ->tgl_mutasi);
        $this->gudang_asal_id = $stockMutasi ->gudangAsal->nama;
        $this->gudang_tujuan_id = $stockMutasi ->gudangTujuan->nama;
        $this->keterangan = $stockMutasi ->keterangan;

        $this->detailStockMutasi= $stockMutasi ->stockMutasiDetail;
        $this->emit('showDetailModal');
    }

    public function closeModal()
    {
        $this->emit('hideDetailModal');
    }
}
