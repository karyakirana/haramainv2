<?php

namespace App\Http\Livewire\Tax;

use App\Models\Master\Perusahaan;
use Livewire\Component;

class PerusahaanForm extends Component
{
    protected $listeners = [
        'perusahaanAdd'=>'perusahaanAdd',
        'edit'=>'edit',
        'destroy'=>'destroy',
        'resetForm'=>'resetForm'
    ];
    public $kode, $nama, $alamat, $npwp;
    public $maximal, $keterangan;
    public $perusahaan_id;

    public function render()
    {
        return view('livewire.tax.perusahaan-form');
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->resetErrorBag();
        $this->reset();
    }

    public function kode()
    {
        $perusahaan = Perusahaan::latest('kode')->first();
        if (!$perusahaan){
            $num = 1;
        } else {
            $lastNum = (int) $perusahaan->last_num_kode;
            $num = $lastNum + 1;
        }
        return "P".sprintf("%05s", $num);
    }

    public function perusahaanAdd()
    {
        $this->emit('showTaxModal');
    }

    public function store()
    {
        $this->validate([
            'nama'=>'required|min:3',
            'alamat'=>'required',
            'npwp'=>'required',
        ]);

        Perusahaan::updateOrCreate(
            [
                'id'=>$this->perusahaan_id,
            ],
            [
                'kode'=>$this->kode ?? $this->kode(),
                'nama'=>$this->nama,
                'alamat'=>$this->alamat,
                'npwp'=>$this->npwp,
                'maximal'=>$this->maximal,
                'keterangan'=>$this->keterangan,
            ]
        );
        $this->emit('hideTaxModal');
    }

    public function edit(Perusahaan $perusahaan)
    {
        $this->perusahaan_id = $perusahaan->id;
//        dd($this->perusahaan_id);
        $this->kode = $perusahaan ->kode;
        $this->nama = $perusahaan ->nama;
        $this->alamat = $perusahaan ->alamat;
        $this->npwp = $perusahaan ->npwp;
        $this->maximal = $perusahaan ->maximal;
        $this->keterangan = $perusahaan ->keterangan;
        $this->emit('showTaxModal');
    }

    public function destroy($id)
    {
        $idPerusahaan = Perusahaan::query()->find($id);
        $idPerusahaan->delete($id);
        $this->emit('showConfirmModal');
        $this->resetForm();

    }


}
