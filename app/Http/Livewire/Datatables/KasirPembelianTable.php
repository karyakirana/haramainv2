<?php

namespace App\Http\Livewire\Datatables;

use App\Http\Services\Repositories\KasirPembelianRepository;
use App\Models\Kasir\Pembelian;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class KasirPembelianTable extends DataTableComponent
{
    protected $pembelianRepo;

    protected string $pageName = 'pembelian';
    protected string $tableName = 'pembelianList';


    protected $listeners = [
        'refreshPembelianTable' => '$refresh',
        'destroySure'=>'destroySure',
        'printBiasa'=>'printBiasa'
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->pembelianRepo = new KasirPembelianRepository();
    }

    public $idPembelian;

    public function columns(): array
    {
        return [
            Column::make('ID', 'kode')
                ->sortable()
                ->searchable()
                ->addClass('hidden md:table-cell')
                ->selected(),
            Column::make('Supplier', 'supplier.nama')
                ->sortable()
                ->searchable(),
            Column::make('Tgl Nota', 'tgl_nota')
                ->sortable()
                ->searchable(),
            Column::make('Tgl Tempo', 'tgl_tempo')
                ->sortable()
                ->searchable(),
            Column::make('Jenis Bayar', 'jenis_bayar')
                ->sortable()
                ->searchable(),
            Column::make('Status Bayar', 'status_bayar')
                ->sortable()
                ->searchable(),
            Column::make('Total Bayar', 'total_bayar')
                ->sortable()
                ->searchable(),
            Column::make('Action', 'actions'),
        ];
    }

    public function query(): Builder
    {
        return Pembelian::query()
            ->with(['users', 'supplier', 'gudang'])
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');
    }

    public function edit($pembelian)
    {
        return redirect()->to('kasir/pembelian/trans/'.$pembelian);
    }

    public function print($id)
    {
        return redirect()->to(''.$id);
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.kasir_pembelian_table';
    }
}
