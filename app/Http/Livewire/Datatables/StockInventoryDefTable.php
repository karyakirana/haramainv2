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

    public function columns(): array
    {
        return [
            Column::make('ID', 'produk.kode_lokal')
                ->sortable(function (Builder $query, $direction){
                    return $query->orderBy(Produk::query()->select('kode_lokal')->whereColumn('produk.id', 'stock_inventory.produk_id'), $direction);
                }),
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
}
