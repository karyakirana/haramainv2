<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Master\Produk;
use App\Models\Stock\StockInventory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StockInventoryTable extends DataTableComponent
{

    public $jenis, $gudang_id;
    protected $listeners = [
        'refreshStockInventory'=>'$refresh'
    ];

    public bool $columnSelect = true;

    public function columns(): array
    {
        return [
            Column::make('ID', 'produk.kode_lokal')
                ->sortable(function (Builder $query, $direction){
                    return $query->orderBy(Produk::query()->select('kode_lokal')->whereColumn('produk.id', 'stock_inventory.produk_id'), $direction);
                })
                ->searchable(),
            Column::make('Jenis', 'jenis')
                ->sortable()
                ->searchable(),
            Column::make('Gudang', 'gudang.nama')
                ->sortable()
                ->searchable(),
            Column::make('Produk', 'produk.nama')
                ->sortable()
                ->searchable(),
            Column::make('Stock Awal', 'stock_awal')
                ->sortable()
                ->searchable(),
            Column::make('Stock Opname', 'stock_opname')
                ->sortable()
                ->searchable(),
            Column::make('Stock Masuk', 'stock_masuk')
                ->sortable()
                ->searchable(),
            Column::make('Stock Keluar', 'stock_keluar')
                ->sortable()
                ->searchable(),
            Column::make('Stock Lost', 'stock_lost')
                ->sortable()
                ->searchable(),
            Column::make('Sisa Stok'),
        ];
    }

    public function query(): Builder
    {
        $stockInventory = StockInventory::query()
            ->where('active_cash', session('ClosedCash'));
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
        return 'livewire-tables.rows.stock_inventory_table';
    }
}
