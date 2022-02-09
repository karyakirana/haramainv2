<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Master\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PegawaiSetTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Kode', 'kode'),
            Column::make('Column Name', 'nama'),
            Column::make('Telepon', 'telepom'),
            Column::make('Alamat', 'alamat'),
            Column::make('set'),
        ];
    }

    public function query(): Builder
    {
        return Pegawai::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.pegawai_set_table';
    }
}
