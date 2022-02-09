<?php

namespace App\Http\Livewire\Keuangan\Report;

use App\Models\Keuangan\JurnalTransaksi;
use Livewire\Component;

class CashFlowHarianForm extends Component
{
    public $tanggal;
    public $reportCashFlow;
    public $jurnal;

    public function render()
    {
        return view('livewire.keuangan.report.cash-flow-harian')->layout('layouts.metronics');
    }

    public function mount()
    {
        $this->tanggal = tanggalan_format(now('ASIA/JAKARTA'));
        $this->getCashFlow();
    }

    public function getCashFlow()
    {
        $this->jurnal = JurnalTransaksi::query()
            ->whereRelation('akun.akunTipe', 'kode', '=', '111')
            ->orWhereRelation('' )
            ->get();
//        dd($this->jurnal);
    }
}
