<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Tax\TaxPenjualan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TaxPenjualanMonthlyTable extends DataTableComponent
{
    protected $listeners =[
        'refreshTaxMonthly'=>'$refresh',
        'setMonth'=>'setMonth'
    ];

    public $month;

    public function setMonth($month)
    {
        $this->month = $month;
    }

    public function mount()
    {
        $this->month = (int) date('m', strtotime(now('ASIA/JAKARTA')));
    }

    public function columns(): array
    {
        return [
            Column::make('Nama Perusahan'),
            Column::make('NPWP'),
            Column::make('Total Omset'),
        ];
    }

    public function query(): Builder
    {
        return TaxPenjualan::query()
            ->select('*')
            ->selectRaw('SUM(total_bayar) as total_keseluruhan')
            ->whereHas('penjualan', function ($query){
                $query->whereRaw('MONTH(tgl_nota) = '.$this->month.' AND  YEAR(tgl_nota)='.date('Y', strtotime(now('ASIA/JAKARTA'))));
            })
            ->groupBy('perusahaan_id');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.tax_penjualan_monthly_table';
    }
}
