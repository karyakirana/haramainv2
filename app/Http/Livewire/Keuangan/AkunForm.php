<?php

namespace App\Http\Livewire\Keuangan;

use App\Models\Keuangan\Akun;
use App\Models\Keuangan\AkunKategori;
use App\Models\Keuangan\AkunTipe;
use Livewire\Component;

class AkunForm extends Component
{
    protected $listeners = [
        'add'=>'add',
        'resetForm'=>'resetForm',
        'edit'=>'edit',
        'destroy'=>'destroy'
    ];

    public $akun_id, $kategori, $tipe, $kode, $deskripsi, $keterangan;

    public function render()
    {
        return view('livewire.keuangan.akun-form', [
            'kategoriData'=>AkunKategori::all(),
            'tipeData'=>AkunTipe::all()
        ]);
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
            'deskripsi'=>'required|min:3',
        ]);

        Akun::updateOrCreate(
            [
                'id'=>$this->akun_id,
            ],
            [
                'kode'=>$this->kode,
                'akun_kategori_id'=>$this->kategori,
                'akun_tipe_id'=>$this->tipe,
                'deskripsi'=>$this->deskripsi,
                'keterangan'=>$this->keterangan
            ]
        );
        $this->emit('store');
        $this->emit('hideModal');
    }

    public function edit(Akun $akun)
    {
        $this->akun_id = $akun->id;
        $this->kategori = $akun->akun_kategori_id;
        $this->kode = $akun->kode;
        $this->tipe = $akun->akun_tipe_id;
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
        $this->idCustomer->destroy($this->id);
    }
}
