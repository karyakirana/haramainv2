<?php

namespace App\Http\Livewire\Penjualan;

use Livewire\Component;

class ReportPenjualanWire extends Component
{
    public function render()
    {
        return view('livewire.penjualan.report-penjualan-wire');
    }

    public $startDate, $endDate;

    public function mount()
    {
        $this->startDate = tanggalan_format(now('ASIA/JAKARTA')->addMonth(-1));
        $this->endDate = tanggalan_format(now('ASIA/JAKARTA'));
        $this->setDate();
    }

    public function setDate()
    {
        $this->emit('setStartDate', tanggalan_database_format($this->startDate, 'd-M-Y'));
        $this->emit('setEndDate', tanggalan_database_format($this->endDate, 'd-M-Y'));
    }

    public function print()
    {
        return redirect()->to('penjualan/report/print/'.tanggalan_database_format($this->startDate, 'd-M-Y').'/'.tanggalan_database_format($this->endDate, 'd-M-Y'));
    }
}
