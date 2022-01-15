<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Gudang;
use Livewire\Component;

class GudangForm extends Component
{
    public $idGudang, $nama, $alamat, $kota, $keterangan;

    protected $listeners = [
        'gudangAdd'=>'gudangAdd',
        'resetForm'=>'resetForm',
        'gudangEdit'=>'edit',
        'gudangDelete'=>'destroy'
    ];

    public function resetForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate([
            'nama'=>'required|min:3',
        ]);

        Gudang::updateOrCreate(
            [
                'id'=>$this->idGudang,
            ],
            [
                'nama'=>$this->nama,
                'alamat'=>$this->alamat,
                'kota'=>$this->kota,
                'keterangan'=>$this->keterangan
            ]
        );
        $this->emit('storeGudang');
        $this->emit('hideGudangModal');
    }

    public function edit(Gudang $gudang)
    {
        $this->idGudang = $gudang->id;
        $this->nama = $gudang->nama;
        $this->alamat = $gudang->alamat;
        $this->kota = $gudang->kota;
        $this->keterangan = $gudang->keterangan;
        $this->emit('showGudangModal');
    }

    public function gudangAdd()
    {
        $this->emit('showGudangModal');
    }

    public function destroy($id)
    {
        //
    }

    public function render()
    {
        return view('livewire.master.gudang-form');
    }
}
