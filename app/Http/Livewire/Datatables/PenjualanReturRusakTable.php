<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Penjualan\PenjualanRetur;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PenjualanReturRusakTable extends DataTableComponent
{

    protected string $pageName = 'returRusak';
    protected string $tableName = 'returRusakList';

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
        return PenjualanRetur::query()
            ->with(['customer', 'users', 'gudang'])
            ->where('active_cash', session('ClosedCash'))
            ->where('jenis_retur', 'rusak')
            ->latest('kode');
    }

    public function edit($id)
    {
        return redirect()->to('retur/rusak/edit/'.$id);
    }

    public function print($id)
    {
        return redirect()->to(''.$id);
    }


    public function rowView(): string
    {
        return 'livewire-tables.rows.penjualan_retur_rusak_table';
    }
}
