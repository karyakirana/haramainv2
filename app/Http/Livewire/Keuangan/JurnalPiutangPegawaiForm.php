<?php

namespace App\Http\Livewire\Keuangan;

use App\Models\Keuangan\JurnalPiutangPegawai;
use App\Models\Keuangan\JurnalPiutangPegawaiDetail;
use App\Models\Master\Pegawai;
use Illuminate\Database\QueryException;
use Livewire\Component;

class JurnalPiutangPegawaiForm extends Component
{
    // listeners
    protected $listeners = [
        ''
    ];

    // form-utama
    public $pegawai, $pegawai_id, $pegawai_nama;
    public $status;
    public $nominal;
    public $tanggal;
    public $keterangan;

    // table
    public $enableTableHutang = false;
    public $dataHutangPegawai = [];

    public function render()
    {
        return view('livewire.keuangan.jurnal-piutang-pegawai-form')
            ->layout('layouts.metronics');
    }

    public function mount($id = null)
    {
        $this->tanggal = tanggalan_format(now('ASIA/JAKARTA'));
    }

    public function setPegawai(Pegawai $pegawai)
    {
        $this->pegawai_id = $pegawai->id;
        $this->pegawai_nama = $pegawai->nama;

        $hutangPegawai = JurnalPiutangPegawaiDetail::query()
            ->whereRelation('jurnalPiutangPegawai', 'pegawai_id', $pegawai->id)
            ->get();
        foreach ($hutangPegawai as $item)
        {
            $this->dataHutangPegawai [] = [
                'kode'=>$item->jurnalPiutangPegawai->kode,
                'tanggal'=>$item->jurnalPiutangPegawai->tgl_piutang,
                'debet'=>$item->nominal_debet,
                'kredit'=>$item->nominal_kredit,
                'saldo'=>$item->nominal_saldo,
            ];
        }
    }

    public function store()
    {
        $this->validate([
            'pegawai_nama'=>'required',
            'tanggal'=>'required',
            'nominal'=>'required',
            'keterangan'=>'required'
        ]);

        \DB::beginTransaction();
        try {
            $jurnalPiutang = JurnalPiutangPegawai::query()
                ->create([
                    'active_cash',
                    'kode',
                    'pegawai_id'=>$this->pegawai_id,
                    'tgl_piutang'=>$this->tanggal,
                    'status'=>$this->status,
                    'nominal'=>$this->nominal,
                    'user_id'=>auth()->id(),
                    'keterangan',
                ]);
            \DB::commit();
        } catch (QueryException $e){
            \DB::rollBack();
        }
    }
}
