<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PenjualanByTempo extends DataTableComponent
{

    protected string $pageName = 'penjualan';
    protected string $tableName = 'penjualanByTempo';


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
        return Penjualan::query()
            ->where('jenis_bayar', 'Tempo')
            ->orWhere('jenis_bayar', 'tempo');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.penjualan_by_tempo';
    }
}
