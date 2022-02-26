<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Kasir\ReturPembelian;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PembelianReturBaikTable extends DataTableComponent
{

    protected string $pageName = 'returBaik';
    protected string $tableName = 'returBaikList';

    public function columns(): array
    {
        return [
            Column::make('ID', 'kode')
                ->sortable()
                ->searchable()
                ->addClass('hidden md:table-cell')
                ->selected(),
            Column::make('Supplier', 'supplier.nama')
                ->sortable()
                ->searchable(),
            Column::make('Tgl Nota', 'tgl_nota')
                ->sortable()
                ->searchable(),
            Column::make('Tgl Tempo', 'tgl_tempo')
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
        return ReturPembelian::query()
            ->with(['supplier', 'users', 'gudang'])
            ->where('active_cash', session('ClosedCash'))
            ->where('jenis_bayar', 'Tempo')
            ->latest('kode');
    }

    public function edit($id)
    {
        return redirect()->to('kasir/pembelian/retur/baik/trans/'.$id);
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.pembelian_retur_baik_table';
    }
}
