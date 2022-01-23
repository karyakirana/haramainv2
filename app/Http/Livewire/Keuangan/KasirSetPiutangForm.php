<?php

namespace App\Http\Livewire\Keuangan;

use App\Models\Keuangan\Akun;
use App\Models\Master\Customer;
use App\Models\Penjualan\Penjualan;
use Livewire\Component;

class KasirSetPiutangForm extends Component
{
    protected $listeners = [
        'setCustomer'=>'setCustomer',
        'setPenjualan'=>'setPenjualan'
    ];

    public $setPiutang;
    public $daftarPiutang = [];
    public $update = false;

    public $penerimaan;

    public $tgl_jurnal, $customer_id, $customer_nama, $total_bayar, $user_id, $keterangan;
    public $total_bayar_rupiah;


    public function render()
    {
        return view('livewire.keuangan.kasir-set-piutang-form',[
            'akunPenerimaan'=>Akun::query()->whereRelation('akunTipe', 'kode', '=', '1')->get()
        ]);
    }

    public function showCustomer()
    {
        $this->emit('showCustomer');
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer_id = $customer->id;
        $this->customer_nama = $customer->nama;
        $this->emit('hideCustomer');
    }

    public function showPenjualan()
    {
        $this->emit('showPenjualanModal');
    }

    public function setPenjualan($id)
    {
        $penjualan = Penjualan::query()->find($id);
        $this->daftarPiutang [] = [
            'penjualan_id'=>$penjualan->id,
            'penjualan_kode'=>$penjualan->kode,
            'penjualan_customer'=>$penjualan->customer->nama,
            'penjualan_total_bayar'=>$penjualan->total_bayar
        ];
        $this->hitung_total();
        $this->emit('hidePenjualanModal');
    }


    public function hitung_total()
    {
        // hitung total
        $this->total_bayar = array_sum(array_column($this->daftarPiutang, 'total_bayar'));
        $this->total_bayar_rupiah = rupiah_format($this->total_bayar);
    }

}
