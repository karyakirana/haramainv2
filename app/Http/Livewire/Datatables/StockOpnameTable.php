<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Stock\StockOpname;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class StockOpnameTable extends DataTableComponent
{
    public $jenis;
    protected string $pageName = 'stockOpname';
    protected string $tableName = 'stockOpnameList';

    public function mount($jenis = null)
    {
        $this->jenis = $jenis;
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
            Column::make('Jenis', 'jenis')
                ->sortable()
                ->searchable(),
            Column::make('Tgl Input', 'tgl_input')
                ->sortable()
                ->searchable(),
            Column::make('Action', 'actions')
                ->sortable()
                ->searchable(),
        ];
    }

    public function query(): Builder
    {
        $stockOpname = StockOpname::query()
            ->with(['gudang', 'pegawai', 'users'])
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');

        if ($this->jenis){
            return $stockOpname->where('jenis', $this->jenis);
        }

        return $stockOpname;
    }


    public function edit($id)
    {
        return redirect()->to('stock/opname/baik/edit/'.$id);
    }

    public function editRusak($id)
    {
        return redirect()->to('stock/opname/rusak/edit/'.$id);
    }

    public function print($id)
    {
        return redirect()->to(''.$id);
    }
    public function rowView(): string
    {
        return 'livewire-tables.rows.stock_opname_table';
    }
}
