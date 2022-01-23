<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Keuangan\Akun;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DaftarAkunPenerimaan extends DataTableComponent
{
    protected string $pageName = 'akun';
    protected string $tableName = 'akunPenerimaan';

    public function columns(): array
    {
        return [
            Column::make('Kategori', 'akunKategori.deskripsi')
                ->sortable()
                ->searchable(),
            Column::make('Tipe', 'akunTipe.deskripsi')
                ->sortable()
                ->searchable(),
            Column::make('Kode', 'kode')
                ->sortable()
                ->searchable(),
            Column::make('Deskripsi', 'deskripsi')
                ->sortable()
                ->searchable(),
        ];
    }

    public function query(): Builder
    {
        return Akun::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.daftar_akun_penerimaan';
    }
}
