<?php

namespace App\Http\Livewire\Keuangan;

use App\Http\Services\Repositories\JurnalSetPiutangRepo;
use App\Models\Keuangan\Akun;
use App\Models\Keuangan\JurnalPenjualan;
use App\Models\Master\Customer;
use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class KasirSetPiutangForm extends Component
{
    protected $listeners = [
        'setCustomer'=>'setCustomer',
        'setPenjualan'=>'setPenjualan'
    ];

    protected $jurnalSetPiutangRepo;
    // debit . kredit
    public $penerimaan, $akunKredit;

    public $setPiutang;
    public $daftarPiutang = [];
    public $update = false;

    public $notification = false;
    public $notificationMessage;

    public $tgl_jurnal, $customer_id, $customer_nama, $total_bayar, $user_id, $keterangan;
    public $total_bayar_rupiah;

    public $jurnal_piutang_id;


    public function render()
    {
        return view('livewire.keuangan.kasir-set-piutang-form',[
            'akunPenerimaan'=>Akun::query()->whereRelation('akunTipe', 'kode', '=', '112')->get()
        ]);
    }

    public function mount($piutangId = null)
    {
        $akunPenjualan = Akun::query()
            ->where('kode', '41100');

        // tgl_penerimaan
        $this->tgl_jurnal = tanggalan_format(strtotime(now()));

        // check akun penjualan sudah ada atau belum
        if ($akunPenjualan->doesntExist()){
            $this->notification = true;
            $this->notificationMessage = 'Akun Penjualan dengan kode 411 belum dibuat';
        } else {
            $this->akunKredit = $akunPenjualan->first()->id;
        }

        // kepentingan edit
        if ($piutangId){
            $piutang = JurnalPenjualan::query()->find($piutangId);
            $this->jurnal_piutang_id = $piutang->id;
            $this->tgl_jurnal = tanggalan_format($piutang->tgl_jurnal);
            $this->customer_id = $piutang->customer_id;
            $this->customer_nama = $piutang->customer->nama;
            $this->total_bayar = $piutang->total_bayar;
            $this->keterangan = $piutang->keterangan;
            foreach ($piutang->jurnalPenjualanDetail as $item){
                $this->daftarPiutang [] = [
                    'penjualan_id'=>$item->penjualan_id,
                    'penjualan_kode'=>$item->penjualan->kode,
                    'penjualan_customer'=>$item->penjualan->customer->nama,
                    'penjualan_total_bayar'=>$item->penjualan->total_bayar
                ];
            }
            foreach ($piutang->jurnalTransaksi as $item){
                if ($item->nominal_debet > 0){
                    $this->penerimaan = $item->akun_id;
                }
            }
            // set update true
            $this->update = true;
        }
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->jurnalSetPiutangRepo = new JurnalSetPiutangRepo();
    }

    public function showCustomer()
    {

        $this->emit('showCustomer');
    }

    public function setCustomer(Customer $customer)
    {
        $this->customer_id = $customer->id;
        $this->customer_nama = $customer->nama;
        $this->emit('hideCustomer');
    }

    public function showPenjualan()
    {
        $this->validate([
            'customer_id'=>'required'
        ]);
        $this->emit('showPenjualanModal', $this->customer_id);
    }

    public function setPenjualan($id)
    {
        $penjualan = Penjualan::query()->find($id);
        $this->daftarPiutang [] = [
            'penjualan_id'=>$penjualan->id,
            'penjualan_kode'=>$penjualan->kode,
            'penjualan_customer'=>$penjualan->customer->nama,
            'penjualan_total_bayar'=>$penjualan->total_bayar
        ];
        $this->hitung_total();
        $this->emit('hidePenjualanModal');
    }

    public function destroyLine($index)
    {
        unset($this->daftarPiutang[$index]);
        $this->daftarPiutang = array_values($this->daftarPiutang);
        $this->hitung_total();
    }


    public function hitung_total()
    {
        // hitung total
        $this->total_bayar = array_sum(array_column($this->daftarPiutang, 'penjualan_total_bayar'));
        $this->total_bayar_rupiah = rupiah_format($this->total_bayar);
    }

    public function store()
    {
        $data = (object) [
            'tgl_jurnal'=>$this->tgl_jurnal,
            'customer_id'=>$this->customer_id,
            'total_bayar'=>$this->total_bayar,
            'keterangan'=>$this->keterangan,

            'detail'=>$this->daftarPiutang,

            'akunDebet'=>$this->penerimaan,
            'akunKredit'=>$this->akunKredit

        ];
        DB::beginTransaction();
        try {
            $this->jurnalSetPiutangRepo->store($data);
            DB::commit();
            return redirect()->to('/keuangan/kasir/set/piutang');
        } catch (ModelNotFoundException $e){
            DB::rollBack();
            session()->flash('message', $e);
        }
    }

    public function update()
    {
        $data = (object) [
            'jurnal_penjualan_id'=>$this->jurnal_piutang_id,
            'tgl_jurnal'=>$this->tgl_jurnal,
            'customer_id'=>$this->customer_id,
            'total_bayar'=>$this->total_bayar,
            'keterangan'=>$this->keterangan,

            'detail'=>$this->daftarPiutang,

            'akunDebet'=>$this->penerimaan,
            'akunKredit'=>$this->akunKredit

        ];
        DB::beginTransaction();
        try {
            $this->jurnalSetPiutangRepo->update($data);
            DB::commit();
            return redirect()->to('/keuangan/kasir/set/piutang');
        } catch (ModelNotFoundException $e){
            DB::rollBack();
            session()->flash('message', $e);
        }
    }

}
