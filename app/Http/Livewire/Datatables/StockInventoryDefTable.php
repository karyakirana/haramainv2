<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Master\Produk;
use App\Models\Stock\StockInventory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StockInventoryDefTable extends DataTableComponent
{

    public $jenis, $gudang_id;

    public bool $perPageAll = true;

    public function columns(): array
    {
        return [
            Column::make('Gudang')
                ->addClass('text-center'),
            Column::make('produk')
                ->addClass('text-center')
                ->sortable(function (Builder $query, $direction){
                    return $query->orderBy(Produk::query()->select('nama')->whereColumn('produk.id', 'stock_inventory.produk_id'), $direction);
                }),
            Column::make('Stock Opname',)
                ->addClass('text-center'),
            Column::make('Stock Masuk')
                ->addClass('text-center'),
            Column::make('Stock Keluar')
                ->addClass('text-center'),
            Column::make('Stock Sisa')
                ->addClass('text-center'),
        ];
    }

    public function query(): Builder
    {
        $stockInventory = StockInventory::query()
            ->where('active_cash', session('ClosedCash'))
            ->where('jenis', 'baik')
            ->select("*")
            ->selectRaw('stock_opname + stock_masuk - stock_keluar as stock_sisa')
            ->whereRaw('(stock_opname + stock_masuk - stock_keluar) < 50')
            ->limit(20);
        if ($this->gudang_id){
            $stockInventory = $stockInventory->where('gudang_id', $this->gudang_id );
        }
        if ($this->jenis){
            $stockInventory = $stockInventory->where('jenis', $this->jenis);
        }
        return $stockInventory;
    }

    public function rowView(): string
    {
        // Becomes /resources/views/location/to/my/row.blade.php
        return 'livewire-tables.rows.stock_inventory_def_table';
    }
}
