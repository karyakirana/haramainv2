<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Stock\StockInventory;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class DashboardStockTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Column Name'),
        ];
    }

    public function query(): Builder
    {
        return StockInventory::query()
            ->selectRaw('produk_id, sum(stock_masuk) as jumlah_stock_masuk, sum(stock_keluar) as jumlah_stock_keluar')
            ->with(['produk'])
            ->groupBy('produk_id');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.dashboard_stock_table';
    }
}
