<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PenjualanTable extends DataTableComponent
{
    protected string $pageName = 'penjualan';
    protected string $tableName = 'penjualanList';

    public function columns(): array
    {
        return [
            Column::make('ID', 'kode')
                ->sortable()
                ->searchable()
                ->addClass('hidden md:table-cell')
                ->selected(),
            Column::make('Customer', 'customer.nama')
                ->sortable()
                ->searchable(),
            Column::make('Tgl Nota', 'tgl_nota')
                ->sortable()
                ->searchable(),
            Column::make('Tgl Tempo', 'tgl_tempo')
                ->sortable()
                ->searchable(),
            Column::make('Jenis Bayar', 'jenis_bayar')
                ->sortable()
                ->searchable(),
            Column::make('Status Bayar', 'status_bayar')
                ->sortable()
                ->searchable(),
            Column::make('Total Bayar', 'total_bayar')
                ->sortable()
                ->searchable(),
            Column::make('Action', 'actions')
                ->sortable()
                ->searchable(),
        ];
    }

    public function query(): Builder
    {
        return Penjualan::query()
            ->with(['customer', 'gudang', 'users'])
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');
    }

    public function edit($id)
    {
        return redirect()->to('penjualan/edit/'.$id);
    }

    public function print($id)
    {
        return redirect()->to('penjualan/print/'.$id);
    }


    public function rowView(): string
    {
        return 'livewire-tables.rows.penjualan_table';
    }
}
