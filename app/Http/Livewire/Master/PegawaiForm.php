<?php

namespace App\Http\Livewire\Master;

use App\Models\Master\Pegawai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PegawaiForm extends Component
{
    protected $listeners = [
        'pegawaiAdd'=>'pegawaiAdd',
        'resetForm'=>'resetForm',
        'pegawaiEdit'=>'pegawaiEdit',
        'pegawaiDelete'=>'pegawaiDelete'
    ];

    public $idPegawai, $kode, $nama, $user_id, $gender;
    public $jabatan, $telepon, $alamat, $keterangan;


    public function render()
    {
        return view('livewire.master.pegawai-form');
    }


    public function kode()
    {
        $pegawai = Pegawai::latest('kode')->first();
        if (!$pegawai){
            $num = 1;
        } else {
            $lastNum = (int) $pegawai->last_num_kode;
            $num = $lastNum + 1;
        }
        return "P".sprintf("%05s", $num);
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->resetErrorBag();
    }

    public function store()
    {
        $this->validate([
            'nama'=>'required|min:3',
        ]);

        Pegawai::updateOrCreate(
            [
                'id'=>$this->idPegawai,
            ],
            [
                'kode'=>$this->kode ?? $this->kode(),
                'user_id'=>Auth::id(),
                'nama'=>$this->nama,
                'gender'=>$this->gender,
                'jabatan'=>$this->jabatan,
                'telepon'=>$this->telepon,
                'alamat'=>$this->alamat,
                'keterangan'=>$this->keterangan
            ]
        );
        $this->emit('storePegawai');
        $this->emit('hidePegawaiModal');
    }

    public function pegawaiEdit(Pegawai $pegawai)
    {
        $this->idPegawai = $pegawai->id;
        $this->kode = $pegawai->kode;
        $this->nama = $pegawai->nama;
        $this->gender = $pegawai->gender;
        $this->jabatan = $pegawai->jabatan;
        $this->telepon = $pegawai->telepon;
        $this->alamat = $pegawai->alamat;
        $this->keterangan = $pegawai->keterangan;
        $this->emit('showPegawaiModal');
    }


    public function pegawaiAdd()
    {
        $this->emit('showPegawaiModal');
    }

    public function pegawaiDelete($id)
    {
        $this->idPegawai->destroy($this->id);
    }
}
