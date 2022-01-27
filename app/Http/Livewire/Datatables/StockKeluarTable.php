<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Stock\StockKeluar;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StockKeluarTable extends DataTableComponent
{

    public $kondisi;
    protected string $pageName = 'stockKeluar';
    protected string $tableName = 'stockKeluarList';

    public function mount($kondisi = null)
    {
        $this->kondisi = $kondisi;
    }
    public function columns(): array
    {
        return [
            Column::make('ID', 'kode')
                ->sortable()
                ->searchable()
                ->addClass('hidden md:table-cell')
                ->selected(),
            Column::make('Gudang', 'gudang.nama')
                ->sortable()
                ->searchable(),
            Column::make('Tgl Keluar', 'tgl_keluar')
                ->sortable()
                ->searchable(),
            Column::make('Supplier', 'supplier.nama')
                ->sortable()
                ->searchable(),
            Column::make('Pembuat', 'users.nama')
                ->sortable()
                ->searchable(),
            Column::make('Action', 'actions')
                ->sortable()
                ->searchable(),
        ];
    }

    public function query(): Builder
    {
        $stockKeluar = StockKeluar::query()
            ->with(['gudang', 'supplier', 'users'])
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        if ($this->kondisi){
            return $stockKeluar->where('kondisi', $this->kondisi);
        }

        return $stockKeluar;
    }


    public function edit($id)
    {
        return redirect()->to('stock/keluar/baik/edit/'.$id);
    }

    public function editRusak($id)
    {
        return redirect()->to('stock/keluar/rusak/edit/'.$id);
    }

    public function print($id)
    {
        return redirect()->to(''.$id);
    }
    public function rowView(): string
    {
        return 'livewire-tables.rows.stock_keluar_table';
    }
}
