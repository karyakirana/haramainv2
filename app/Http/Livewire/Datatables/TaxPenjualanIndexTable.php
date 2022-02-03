<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Tax\TaxPenjualan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TaxPenjualanIndexTable extends DataTableComponent
{

    protected $listeners =[
        'refreshTaxPenjualan'=>'$refresh'
    ];

    public function columns(): array
    {
        return [
            Column::make('Kode'),
            Column::make('Customer'),
            Column::make('Nota'),
            Column::make('Total Bayar'),
            Column::make('Pembuat'),
            Column::make('Keterangan'),
            Column::make(''),
        ];
    }

    public function query(): Builder
    {
        return TaxPenjualan::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.tax_penjualan_index_table';
    }
}
