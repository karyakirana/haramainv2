<?php

namespace App\Http\Livewire\Keuangan;

use App\Http\Services\Repositories\JurnalPenerimaanPenjualanRepo;
use App\Models\Keuangan\Akun;
use App\Models\Keuangan\JurnalPenerimaanPenjualan;
use App\Models\Master\Customer;
use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class JurnalPenerimaanForm extends Component
{
    protected $listeners = [
        'setCustomer'=>'setCustomer',
        'setPenjualan'=> 'setPenjualan',
    ];

    // repository
    protected $jurnalPenerimaanRepo;

    // debit . kredit
    public $penerimaan, $akunKredit;

    public $notification = false;
    public $notificationMessage;

    public $daftarNota = [];
    public $update =false;
    public $total_bayar, $keterangan, $user_id;
    public $total_bayar_rupiah;
    public $customer_id, $customer_nama, $tgl_penerimaan;
    public $penjualan_id, $penjualan_kode, $penjualan_customer, $penjualan_total_bayar;

    public function render()
    {
        return view('livewire.keuangan.jurnal-penerimaan-form',[
            'akunPenerimaan'=>Akun::query()->whereRelation('akunTipe', 'kode', '=', '1')->get()
        ]);
    }

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->jurnalPenerimaanRepo = new JurnalPenerimaanPenjualanRepo();
    }

    public function mount()
    {
        $akunPenjualan = Akun::query()
            ->whereRelation('akunTipe', 'kode','6')
            ->where('kode', '601');

        // check akun penjualan sudah ada atau belum
        if ($akunPenjualan->doesntExist()){
            $this->notification = true;
            $this->notificationMessage = 'Akun Penjualan Belum dibuat';
        } else {
            $this->akunKredit = $akunPenjualan->first()->id;
        }
    }

    public function customNotification()
    {
        $this->emit('showNotificationModal');
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
        $this->emit('showPenjualanModal');
    }

    public function setPenjualan($id)
    {
        $penjualan = Penjualan::query()->find($id);
        $this->daftarNota [] = [
            'penjualan_id'=>$penjualan->id,
            'penjualan_kode'=>$penjualan->kode,
            'penjualan_customer'=>$penjualan->customer->nama,
            'penjualan_total_bayar'=>$penjualan->total_bayar
        ];
        $this->hitung_total();
        $this->emit('hidePenjualanModal');
    }

    public function store()
    {
        $this->validate([
            'penerimaan'=>'required',
            'tgl_penerimaan'=>'required'
        ]);

        $data = (object)[
            'customer_id'=>$this->customer_id,
            'tgl_penerimaan'=>$this->tgl_penerimaan,
            'total_bayar'=>$this->total_bayar,
            'keterangan'=>$this->keterangan,

            'detail'=>$this->daftarNota,

            'akunDebet'=>$this->penerimaan,
            'akunKredit'=>$this->akunKredit
        ];

        DB::beginTransaction();
        try {
            $this->jurnalPenerimaanRepo->store($data);
            DB::commit();
        } catch (ModelNotFoundException $e){
            DB::rollBack();
            session()->flash('message', $e);
        }
        return view('pages.Keuangan.kasir-penerimaan-cash-index');
    }

    public function destroyLine($index)
    {
        // update line
        unset($this->daftarNota[$index]);
        $this->daftarNota = array_values($this->daftarNota);
    }

    public function hitung_total()
    {
        // hitung total
        $this->total_bayar = array_sum(array_column($this->daftarNota, 'penjualan_total_bayar'));
        $this->total_bayar_rupiah = rupiah_format($this->total_bayar);
    }
}
