<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Master\Supplier;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SupplierSetTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Kode', 'supplierJenis.jenis')
                ->searchable()
                ->sortable(),
            Column::make('Nama', 'nama')
                ->searchable()
                ->sortable(),
            Column::make('Alamat', 'alamat'),
            Column::make('Telepon', 'telepon'),
            Column::make('NPWP', 'npwp'),
            Column::make('Email', 'email'),
            Column::make('Keterangan', 'keterangan'),
            Column::make('Action'),
        ];
    }

    public function query(): Builder
    {
        return Supplier::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.supplier_set_table';
    }
}
