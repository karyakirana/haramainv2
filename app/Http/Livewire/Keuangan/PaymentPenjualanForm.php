<?php

namespace App\Http\Livewire\Keuangan;

use App\Models\Keuangan\JurnalPenerimaanPenjualan;
use App\Models\Master\Customer;
use App\Models\Penjualan\Penjualan;
use Livewire\Component;

class PaymentPenjualanForm extends Component
{
    // for table
    public $penjualanTable = [];

    protected $listeners = [
        'setPenjualan'=>'setPenjualan',
        'setCustomer'=>'setCustomer'
    ];

    // variable form utama
    public $tanggal, $jenis, $customer_id, $customer_nama;
    public $akun, $nominal_kas, $nominal_piutang;
    public $keterangan;

    public function render()
    {
        return view('livewire.keuangan.payment-penjualan-form')->layout('layouts.metronics');
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer_id = $customer->id;
        $this->customer_nama = $customer->nama;
    }

    public function setPenjualan(Penjualan $penjualan)
    {
        $this->penjualanTable []=[
            'id'=>$penjualan->id,
            'kode'=>$penjualan->kode,
            'customer'=>$penjualan->customer->nama,
            'jenis'=>$penjualan->jenis_bayar,
            'total_bayar'=>$penjualan->total_bayar
        ];
    }

    public function destroyPenjualan($index)
    {
        unset($this->penjualanTable[$index]);
        $this->penjualanTable = array_values($this->penjualanTable);
    }

    protected function kode()
    {
        //
    }

    public function store()
    {
        $this->validate();

        // store Payment
        $jurnalPenerimaan = JurnalPenerimaanPenjualan::query()->create([
            'kode',
            'tgl_penerimaan',
            'active_cash',
            'customer_id',
            'user_id',
            'total_bayar',
            'keterangan',
        ]);
    }
}
