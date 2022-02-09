<?php

namespace App\Http\Livewire\Keuangan;

use App\Models\Keuangan\Akun;
use App\Models\Keuangan\JurnalPiutangPegawai;
use App\Models\Keuangan\JurnalPiutangPegawaiDetail;
use App\Models\Keuangan\SaldoPiutangPegawai;
use App\Models\Master\Pegawai;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class JurnalPiutangPegawaiForm extends Component
{
    // listeners
    protected $listeners = [
        'setPegawai'=>'setPegawai',
    ];

    // form-utama
    public $pegawai, $pegawai_id, $pegawai_nama;
    public $akun_pegawai, $akun_kas;
    public $status;
    public $nominal;
    public $tanggal;
    public $keterangan;
    public $piutang_id;

    // table
    public $mode = 'create';
    public $update =false;
    public $enableTableHutang = false;
    public $dataHutangPegawai = [];

    public function render()
    {
        return view('livewire.keuangan.jurnal-piutang-pegawai-form', [
            'akunPegawai'=>Akun::query()->whereRelation('akunTipe', 'kode', '113')->get(),
            'akunKas'=>Akun::query()->whereRelation('akunTipe', 'kode', '111')->get(),
        ])
            ->layout('layouts.metronics');
    }
    public function kode()
    {
        // query
        $query = JurnalPiutangPegawai::query()
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        // check last num
        if ($query->doesntExist()){
            return '1/JPP/'.date('Y');
        }

        $num = $query->first()->last_num + 1;
        return $num."/JPP/".date('Y');
    }
    public function mount($piutang_id = null)
    {
        $this->tanggal = tanggalan_format(now('ASIA/JAKARTA'));
        if ($piutang_id)
        {
            $this->mode = 'update';
            $piutang = JurnalPiutangPegawai::query()->find($piutang_id);
            $this->piutang_id = $piutang ->id;
            $this->tanggal = tanggalan_format($piutang->tgl_piutang);
            $this->status = $piutang -> status;
            $this->pegawai_id = $piutang->pegawai_id;
            $this->pegawai_nama = $piutang ->pegawai->nama;
            $this->nominal = $piutang->nominal;
            $this->keterangan = $piutang ->keterangan;

            foreach ($piutang->jurnalPiutangPegawaiDetail as $item)
            {
                $this->dataHutangPegawai [] = [
                    'kode'=>$piutang->kode,
                    'tanggal'=>$piutang->tgl_piutang,
                    'debet'=>$item->nominal_debet,
                    'kredit'=>$item->nominal_kredit,
                    'saldo'=>$item->nominal_saldo,
                ];
            }
            foreach ($piutang->jurnalTransaksi as $item)
            {
                if ($this->status == 'keluar'){
                    if ($item->nominal_kredit == 0){
                        $this->akun_pegawai = $item->akun_id;
                    }else{
                        $this->akun_kas = $item->akun_id;
                    }
                }else{
                    if ($item->nominal_debet == 0) {
                        $this->akun_pegawai = $item->akun_id;
                    }else{
                        $this->akun_kas = $item->akun_id;
                    }

                }
            }
        }
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
        $this->emit('hidePegawai');
    }

    public function addLine()
    {

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
//            dd($this->tanggal);
            $jurnalPiutang = JurnalPiutangPegawai::query()
                ->create([
                    'id'=>$this->piutang_id,
                    'active_cash'=>session('ClosedCash'),
                    'kode'=>$this->kode(),
                    'pegawai_id'=>$this->pegawai_id,
                    'tgl_piutang'=>$this->tanggal,
                    'status'=>$this->status,
                    'nominal'=>$this->nominal,
                    'user_id'=>auth()->id(),
                    'keterangan'=>$this->keterangan,
                ]);
            if ($this->status == 'keluar'){
                $jurnalPiutang -> jurnalTransaksi()->create([
                    'akun_id'=>$this->akun_pegawai,
                    'nominal_debet'=>$this->nominal,
                    'nominal_kredit'=>'0',
                    'keterangan'=>$this->keterangan,
                ]);
                $jurnalPiutang -> jurnalTransaksi()->create([
                    'akun_id'=>$this->akun_kas,
                    'nominal_debet'=>'0',
                    'nominal_kredit'=>$this->nominal,
                    'keterangan'=>$this->keterangan,
                ]);
            }
            else{
                $jurnalPiutang -> jurnalTransaksi()->create([
                    'akun_id'=>$this->akun_kas,
                    'nominal_debet'=>$this->nominal,
                    'nominal_kredit'=>'0',
                    'keterangan'=>$this->keterangan,
                ]);
                $jurnalPiutang -> jurnalTransaksi()->create([
                    'akun_id'=>$this->akun_pegawai,
                    'nominal_debet'=>'0',
                    'nominal_kredit'=>$this->nominal,
                    'keterangan'=>$this->keterangan,
                ]);
            }
            $saldoPiutang = SaldoPiutangPegawai::query()->where('pegawai_id', $this->pegawai_id);
            if ($saldoPiutang->count()>0){
                $tanggalLunas = null;
                if ($this->status == 'masuk'){
                    $tanggalLunas = ($saldoPiutang->first()->saldo == $this->nominal) ? tanggalan_database_format($this->tanggal, 'd-M-Y') : null;
                }
                if ($saldoPiutang->first()->saldo > 0)
                {
                    $saldoPiutang->first()->update([
                        'tgl_lunas'=>$tanggalLunas,
                        'saldo'=>\DB::raw('saldo'.(($this->status == 'masuk') ? ' -' : ' +').$this->nominal),
                    ]);
                } else {
                    $saldoPiutang->first()->update([
                        'tgl_awal'=>tanggalan_database_format($this->tanggal, 'd-M-Y'),
                        'tgl_lunas'=>$tanggalLunas,
                        'saldo'=>\DB::raw('saldo'.(($this->status == 'masuk') ? ' -' : ' +').$this->nominal),
                    ]);
                }

            }else{
                $saldoPiutang = SaldoPiutangPegawai::create([
                    'pegawai_id'=>$this->pegawai_id,
                    'tgl_awal'=>tanggalan_database_format($this->tanggal, 'Y-m-d'),
                    'saldo'=>$this->nominal,
                ]);
            }
            $jurnalPiutang ->jurnalPiutangPegawaiDetail()->create([
                'nominal_debet'=>($this->status == 'masuk') ? 0 : $this->nominal,
                'nominal_kredit'=>($this->status == 'masuk') ? $this->nominal : 0,
                'nominal_saldo'=>$saldoPiutang->first()->saldo,
            ]);

            \DB::commit();
            return redirect()->to('keuangan/kasir/piutang/pegawai');
        } catch (ModelNotFoundException $e){
            \DB::rollBack();
            session()->flash('messages', $e);
        }
    }
    public function update()
    {
        $this->validate([
            'pegawai_nama'=>'required',
            'tanggal'=>'required',
            'nominal'=>'required',
            'keterangan'=>'required'
        ]);

        \DB::beginTransaction();
        try {
//            dd($this->tanggal);
            $jurnalPiutang = JurnalPiutangPegawai::query()
                ->find($this->piutang_id);
            $jurnalPiutang->jurnalTransaksi()->delete();
            $jurnalPiutang->jurnalPiutangPegawaiDetail()->delete();

            $jurnalPiutang
                ->update([
                    'pegawai_id'=>$this->pegawai_id,
                    'tgl_piutang'=>$this->tanggal,
                    'status'=>$this->status,
                    'nominal'=>$this->nominal,
                    'user_id'=>auth()->id(),
                    'keterangan'=>$this->keterangan,
                ]);
            if ($this->status == 'keluar'){
                $jurnalPiutang -> jurnalTransaksi()->create([
                    'akun_id'=>$this->akun_pegawai,
                    'nominal_debet'=>$this->nominal,
                    'nominal_kredit'=>'0',
                    'keterangan'=>$this->keterangan,
                ]);
                $jurnalPiutang -> jurnalTransaksi()->create([
                    'akun_id'=>$this->akun_kas,
                    'nominal_debet'=>'0',
                    'nominal_kredit'=>$this->nominal,
                    'keterangan'=>$this->keterangan,
                ]);
            }
            else{
                $jurnalPiutang -> jurnalTransaksi()->create([
                    'akun_id'=>$this->akun_kas,
                    'nominal_debet'=>$this->nominal,
                    'nominal_kredit'=>'0',
                    'keterangan'=>$this->keterangan,
                ]);
                $jurnalPiutang -> jurnalTransaksi()->create([
                    'akun_id'=>$this->akun_pegawai,
                    'nominal_debet'=>'0',
                    'nominal_kredit'=>$this->nominal,
                    'keterangan'=>$this->keterangan,
                ]);
            }
            $saldoPiutang = SaldoPiutangPegawai::query()->where('pegawai_id', $this->pegawai_id);
            if ($saldoPiutang->count()>0){
                $tanggalLunas = null;
                if ($this->status == 'masuk'){
                    $tanggalLunas = ($saldoPiutang->first()->saldo == $this->nominal) ? tanggalan_database_format($this->tanggal, 'd-M-Y') : null;
                }
                if ($saldoPiutang->first()->saldo > 0)
                {
                    $saldoPiutang->first()->update([
                        'tgl_lunas'=>$tanggalLunas,
                        'saldo'=>\DB::raw('saldo'.(($this->status == 'masuk') ? ' -' : ' +').$this->nominal),
                    ]);
                } else {
                    $saldoPiutang->first()->update([
                        'tgl_awal'=>tanggalan_database_format($this->tanggal, 'd-M-Y'),
                        'tgl_lunas'=>$tanggalLunas,
                        'saldo'=>\DB::raw('saldo'.(($this->status == 'masuk') ? ' -' : ' +').$this->nominal),
                    ]);
                }

            }else{
                $saldoPiutang = SaldoPiutangPegawai::create([
                    'pegawai_id'=>$this->pegawai_id,
                    'tgl_awal'=>tanggalan_database_format($this->tanggal, 'Y-m-d'),
                    'saldo'=>$this->nominal,
                ]);
            }
            $jurnalPiutang ->jurnalPiutangPegawaiDetail()->create([
                'nominal_debet'=>($this->status == 'masuk') ? 0 : $this->nominal,
                'nominal_kredit'=>($this->status == 'masuk') ? $this->nominal : 0,
                'nominal_saldo'=>$saldoPiutang->first()->saldo,
            ]);

            \DB::commit();
            return redirect()->to('keuangan/kasir/piutang/pegawai');
        } catch (ModelNotFoundException $e){
            \DB::rollBack();
            session()->flash('messages', $e);
        }
    }
}
