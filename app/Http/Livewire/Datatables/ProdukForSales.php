<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Master\Produk;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ProdukForSales extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('ID', 'kode_lokal')
                ->searchable(),
            Column::make('Produk', 'nama')
                ->addclass('text-center')
                ->searchable()
                ->sortable(),
            Column::make('Cover')
                ->addclass('text-center')
                ->searchable(),
            Column::make('Hal')
                ->addclass('text-center')
                ->searchable(),
            Column::make('Kategori', 'kategori.kode_lokal')
                ->addclass('text-center'),
            Column::make('Harga')
                ->addclass('text-center'),
            Column::make(''),
        ];
    }

    public function query(): Builder
    {
        return Produk::query()
            ->with(['kategori', 'kategoriharga']);
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.produk_for_sales';
    }
}
