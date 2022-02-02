<?php

namespace App\Http\Livewire\Keuangan;

use App\Models\Keuangan\JurnalPenerimaanPenjualan;
use App\Models\Master\Customer;
use App\Models\Penjualan\Penjualan;
use Livewire\Component;

class JurnalPenerimaanForm extends Component
{
    public $penerimaan;
    public $daftarNota = [];
    public $total_bayar;
    public $total_bayar_rupiah;

    public $customer_nama, $customer_id;
    public $jurnal_penerimaan_id;

    public function render()
    {
        return view('livewire.keuangan.jurnal-penerimaan-form');
    }

    public function mount($jurnalPenerimaanId = null)
    {
//        dd($penjualanId);
        if ($jurnalPenerimaanId){
            $this->jurnal_penerimaan_id = $jurnalPenerimaanId;
            $jurnalPenerimaan = JurnalPenerimaanPenjualan::query()->find($this->jurnal_penerimaan_id);
            $this->customer_id = $jurnalPenerimaan->customer_id;
            $this->customer_nama = $jurnalPenerimaan->customer->nama;
            foreach ($jurnalPenerimaan->jurnalTransaksi as $item){
                $this->daftarNota[] = [
                    'penjualan_id'=>$item->id,
                    'penjualan_kode'=>$item->kode,
                    'penjualan_customer'=>$item->customer->nama,
                    'penjualan_total_bayar'=>$item->total_bayar
                ];
            }
        }
    }

    public function showCustomer()
    {
        $this->emit('showCustomerModal');
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer_id = $customer->id;
        $this->customer_nama = $customer->nama;
        $this->emit('hideCustomerModal');
    }

    public function showPenjualan()
    {
        $this->emit('showPenjualanModal');
    }

    public function addLine($id)
    {
        $penjualan = Penjualan::query()->find($id);
        $this->daftarNota [] = [
            'penjualan_id'=>$penjualan->id,
            'penjualan_kode'=>$penjualan->kode,
            'penjualan_customer'=>$penjualan->customer->nama,
            'penjualan_total_bayar'=>$penjualan->total_bayar
        ];
        $this->hitung_total();
        $this->emit('hidePenjualanModal');
    }

    public function destroyLine()
    {
        // update line
    }

    public function hitung_total()
    {
        // hitung total
        $this->total_bayar = array_sum(array_column($this->daftarNota, 'total_bayar'));
        $this->total_bayar_rupiah = rupiah_format($this->total_bayar);
    }

    public function store()
    {
        //
    }

    public function update()
    {
        //
    }
}
