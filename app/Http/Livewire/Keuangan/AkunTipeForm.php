<?php

namespace App\Http\Livewire\Keuangan;

use App\Models\Keuangan\AkunTipe;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AkunTipeForm extends Component
{
    protected $listeners = [
        'add'=>'add',
        'resetForm'=>'resetForm',
        'edit'=>'edit',
        'destroy'=>'destroy',
    ];

    public $akun_tipe_id, $kode, $deskripsi, $keterangan;

    public function render()
    {
        return view('livewire.keuangan.akun-tipe-form');
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }
    public function store()
    {
        $this->validate([
            'kode'=>['required',
                Rule::unique('akun_tipe', 'kode')->ignore($this->akun_tipe_id)
            ],
            'deskripsi'=>'required|min:3',
        ]);

        AkunTipe::updateOrCreate(
            [
                'id'=>$this->akun_tipe_id,
            ],
            [
                'kode'=>$this->kode,
                'deskripsi'=>$this->deskripsi,
                'keterangan'=>$this->keterangan
            ]
        );
        $this->emit('store');
        $this->emit('hideModal');
    }

    public function edit(AkunTipe $akun)
    {
        $this->akun_tipe_id = $akun->id;
        $this->kode = $akun->kode;
        $this->deskripsi = $akun->deskripsi;
        $this->keterangan = $akun->keterangan;
        $this->emit('showModal');
    }

    public function add()
    {
        $this->emit('showModal');
    }

    public function destroy($id)
    {
        $this->akun_tipe_id = $id;
        $this->emit('showConfirmModal');
    }

    public function destroyConfirm()
    {
        AkunTipe::destroy($this->akun_tipe_id);
        $this->emit('hideConfirmModal');
    }
}
