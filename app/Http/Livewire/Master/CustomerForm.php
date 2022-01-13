<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Customer;
use Livewire\Component;

class CustomerForm extends Component
{
    protected $listeners = [
        'customerAdd'=>'customerAdd',
        'resetForm'=>'resetForm',
        'customerEdit'=>'customerEdit',
        'customerDelete'=>'customerDelete'
    ];
    public $idCustomer, $kode, $nama, $diskon, $telepon, $alamat, $keterangan;

    public function render()
    {
        return view('livewire.master.customer-form');
    }

    public function kode()
    {
        $customer = Customer::latest('kode')->first();
        if (!$customer){
            $num = 1;
        } else {
            $lastNum = (int) $customer->last_num_kode;
            $num = $lastNum + 1;
        }
        return "C".sprintf("%05s", $num);
    }

    public function resetForm()
    {
        $this->resetExcept(['search', 'pagination']);
        $this->resetValidation();
        $this->resetErrorBag();
    }
    public function store()
    {
        $this->validate([
            'nama'=>'required|min:3',
            'diskon'=>'numeric'
        ]);

        Customer::updateOrCreate(
            [
                'id'=>$this->idCustomer,
            ],
            [
                'kode'=>$this->kode ?? $this->kode(),
                'nama'=>$this->nama,
                'diskon'=>$this->diskon,
                'telepon'=>$this->telepon,
                'alamat'=>$this->alamat,
                'keterangan'=>$this->keterangan
            ]
        );
        $this->emit('storeCustomer');
        $this->emit('hideCustomerModal');
    }

    public function customerEdit(Customer $customer)
    {
        $this->idCustomer = $customer->id;
        $this->kode = $customer->kode;
        $this->nama = $customer->nama;
        $this->diskon = $customer->diskon;
        $this->telepon = $customer->telepon;
        $this->alamat = $customer->alamat;
        $this->keterangan = $customer->keterangan;
        $this->emit('showCustomerModal');
    }

    public function customerAdd()
    {
        $this->emit('showCustomerModal');
    }

    public function customerDelete($id)
    {
        $this->idCustomer->destroy($this->id);
    }

}
