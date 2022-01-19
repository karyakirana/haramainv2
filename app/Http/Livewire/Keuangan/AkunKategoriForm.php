<?php

namespace App\Http\Livewire\Keuangan;

use App\Models\Keuangan\AkunKategori;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AkunKategoriForm extends Component
{
    protected $listeners = [
        'add'=>'add',
        'resetForm'=>'resetForm',
        'edit'=>'edit',
        'destroy'=>'destroy',
    ];

    public $akunKategori_id, $kode, $kategori, $keterangan;

    public function render()
    {
        return view('livewire.keuangan.akun-kategori-form');
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
                Rule::unique('akun_kategori', 'kode')->ignore($this->akunKategori_id)
            ],
            'kategori'=>'required|min:3',
            'keterangan'=>''
        ]);

        AkunKategori::updateOrCreate(
            [
                'id'=>$this->akunKategori_id,
            ],
            [
                'kode'=>$this->kode,
                'deskripsi'=>$this->kategori,
                'keterangan'=>$this->keterangan
            ]
        );
        $this->emit('store');
        $this->emit('hideModal');
    }

    public function edit(AkunKategori $akun)
    {
        $this->akunKategori_id = $akun->id;
        $this->kode = $akun->kode;
        $this->kategori = $akun->deskripsi;
        $this->keterangan = $akun->keterangan;
        $this->emit('showModal');
    }

    public function add()
    {
        $this->emit('showModal');
    }

    public function destroy($id)
    {
        $this->akunKategori_id = $id;
        $this->emit('showConfirmModal');
    }

    public function destroyConfirm()
    {
        AkunKategori::destroy($this->akunKategori_id);
        $this->emit('hideConfirmModal');
    }
}
