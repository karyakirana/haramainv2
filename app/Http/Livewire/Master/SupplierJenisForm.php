<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\SupplierJenis;
use Livewire\Component;

class SupplierJenisForm extends Component
{
    protected $listeners = [
    'jenisAdd'=>'jenisAdd',
    'resetForm'=>'resetForm',
    'supplierJenisEdit'=>'supplierJenisEdit',
    'supplierJenisDelete'=>'supplierJenisDelete'
];
    public $idJenis, $jenis, $keterangan;

    public function render()
    {
        return view('livewire.master.supplier-jenis-form');
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate([
            'jenis'=>'required'
        ]);

        SupplierJenis::updateOrCreate(
            [
                'id'=>$this->idJenis,
            ],
            [
                'jenis'=>$this->jenis,
                'keterangan'=>$this->keterangan,
            ]);
        $this->emit('storeSupplierJenis');
        $this->emit('hideJenisModal');
    }

    public function supplierJenisEdit(SupplierJenis $supplierJenis)
    {
        $this->idJenis = $supplierJenis->id;
        $this->jenis = $supplierJenis->jenis;
        $this->keterangan = $supplierJenis->keterangan;
        $this->emit('showJenisModal');
    }

    public function jenisAdd()
    {
        $this->emit('showJenisModal');
    }

    public function supplierJenisDelete($id)
    {
        $this->idJenis->destroy($this->id);
    }

}
