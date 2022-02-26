<?php

namespace App\Http\Livewire\Detail;

use App\Http\Services\Repositories\KasirPembelianRepository;
use App\Models\Kasir\Pembelian;
use Livewire\Component;

class PembelianDetailView extends Component
{
    protected $listeners = [
    'showModal'=>'showModal',
    'showDetailInfo'=>'showDetailInfo',
];
    public $gudang_id, $user_id, $total_barang, $ppn, $biaya_lain, $keterangan;
    public $supplier_id, $jenis_bayar, $tgl_nota, $tgl_tempo, $total_bayar;
    public $idPembelian, $detailPembelian, $pembelian;

    protected $pembelianRepo;

    public function render()
    {
        return view('livewire.detail.pembelian-detail-view');
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->pembelianRepo = new KasirPembelianRepository();
    }

    public function showDetailInfo($id)
    {
        $this->pembelian = Pembelian::query()
            ->where('id', $id)
            ->first();
        $this->detailPembelian = $this->pembelian->pembelianDetail;
    }

    public function showModal($id)
    {
        $pembelian = Pembelian::where('id', $id)->first();

        $this->idPembelian = $pembelian ->id;
        $this->supplier_id = $pembelian ->supplier->nama;
        $this->jenis_bayar = $pembelian ->jenis_bayar;
        $this->tgl_nota = tanggalan_format($pembelian ->tgl_nota);
        $this->tgl_tempo = tanggalan_format($pembelian ->tgl_tempo);
        $this->gudang_id = $pembelian ->gudang->nama;
        $this->total_bayar = $pembelian ->total_bayar;
        $this->keterangan = $pembelian ->keterangan;

        $this->detailPembelian= $pembelian ->pembelianDetail;
        $this->emit('showDetailModal');
    }

    public function closeModal()
    {
        $this->emit('hideDetailModal');
    }

}
