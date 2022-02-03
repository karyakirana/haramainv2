<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ReportPenjualanTable extends DataTableComponent
{

    protected $listeners = [
        'refreshPenjualanTable'=>'$refresh',
        'setStartDate'=>'startDate',
        'setEndDate'=>'endDate'
    ];

    public $startDate, $endDate;

    public function columns(): array
    {
        return [
            Column::make('Kode'),
            Column::make('Customer'),
            Column::make('Tanggal Nota'),
            Column::make('Jenis'),
            Column::make('Tanggal Tempo'),
            Column::make('Pembuat'),
            Column::make('Total Bayar'),
            Column::make(''),
        ];
    }

    public function startDate($startDate)
    {
        $this->startDate = $startDate;
        $this->resetPage();
    }

    public function endDate($endDate)
    {
        $this->endDate = $endDate;
        $this->resetPage();
    }

    public function query(): Builder
    {
        $penjualan = Penjualan::query()
            ->where('active_cash', session('ClosedCash'))
            ->whereBetween('tgl_nota', [now('ASIA/JAKARTA')->addMonth(-1)->addDay(-1), now('ASIA/JAKARTA')])
            ->latest('kode');
        if ($this->startDate && $this->endDate){
            return $penjualan->whereBetween('tgl_nota', [$this->startDate, $this->endDate]);
        }
        return $penjualan;
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.report_penjualan_table';
    }
}
