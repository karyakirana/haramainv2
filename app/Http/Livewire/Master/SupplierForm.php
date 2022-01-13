<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Supplier;
use App\Models\Master\SupplierJenis;
use Livewire\Component;

class SupplierForm extends Component
{
    protected $listeners = [
        'supplierAdd'=>'supplierAdd',
        'resetForm'=>'resetForm',
        'supplierEdit'=>'supplierEdit',
        'supplierDelete'=>'supplierDelete'
    ];
    public $idSupplier, $supplier_jenis_id, $nama, $alamat, $telepon, $npwp, $email, $keterangan;
    public $jenisSupplier;

    public function mount()
    {
        $this->jenisSupplier = SupplierJenis::all();
    }
    public function render()
    {
        return view('livewire.master.supplier-form');
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate([
            'nama'=>'required|min:3'
        ]);
        Supplier::updateOrCreate(
            [
                'id'=>$this->idSupplier,
            ],
            [
                'supplier_jenis_id'=>$this->supplier_jenis_id,
                'nama'=>$this->nama,
                'alamat'=>$this->alamat,
                'telepon'=>$this->telepon,
                'npwp'=>$this->npwp,
                'email'=>$this->email,
                'keterangan'=>$this->keterangan,
            ]);
        $this->emit('storeSupplier');
        $this->emit('hideSupplierModal');
    }

    public function supplierEdit(Supplier $supplier)
    {
        $this->idSupplier = $supplier->id;
        $this->supplier_jenis_id = $supplier->supplier_jenis_id;
        $this->nama = $supplier->nama;
        $this->alamat = $supplier->alamat;
        $this->telepon = $supplier->telepon;
        $this->npwp = $supplier->npwp;
        $this->email = $supplier->email;
        $this->keterangan = $supplier->keterangan;
        $this->emit('showSupplierModal');
    }

    public function supplierAdd()
    {
        $this->emit('showSupplierModal');
    }

    public function supplierDelete($id)
    {
        $this->idSupplier->destroy($this->id);
    }

}
