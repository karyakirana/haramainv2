<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PenjualanByCash extends DataTableComponent
{
    protected string $pageName = 'penjualan';
    protected string $tableName = 'penjualanByCash';

    public function columns(): array
    {
        return [
            Column::make('ID', 'kode')
                ->sortable()
                ->searchable(),
            Column::make('Customer', 'customer.nama')
                ->sortable()
                ->searchable(),
            Column::make('Gudang', 'gudang.nama')
                ->sortable()
                ->searchable(),
            Column::make('Jenis')
                ->sortable(),
            Column::make('Tgl Nota')
                ->sortable(),
            Column::make('Tgl Tempo')
                ->sortable(),
            Column::make('Total Bayar')
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Penjualan::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.penjualan_by_cash';
    }
}
