<?php

namespace App\Http\Livewire\Datatables;

use App\Http\Services\Repositories\PenjualanRepository;
use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PenjualanTable extends DataTableComponent
{
    protected $penjualanRepo;

    protected string $pageName = 'penjualan';
    protected string $tableName = 'penjualanList';

    protected $listeners = [
        'refreshPenjualanTable' => '$refresh',
        'destroySure'=>'destroySure',
        'printBiasa'=>'printBiasa'
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->penjualanRepo = new PenjualanRepository();
    }

    public $idPenjualan;

    public function columns(): array
    {
        return [
            Column::make('ID', 'kode')
                ->sortable()
                ->searchable()
                ->addClass('hidden md:table-cell')
                ->selected(),
            Column::make('Customer', 'customer.nama')
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
        return Penjualan::query()
            ->with(['customer', 'gudang', 'users'])
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');
    }

    public function edit($id)
    {
        return redirect()->to('penjualan/edit/'.$id);
    }

    public function print($id)
    {
        return redirect()->to('penjualan/print/'.$id);
    }

    public function printBiasa($id)
    {
        return redirect()->to('penjualan/printpdf/'.$id);
    }


    public function rowView(): string
    {
        return 'livewire-tables.rows.penjualan_table';
    }

    public function destroy($id)
    {
        $this->idPenjualan = $id;
        $this->emit('showConfirmModal');
    }

    public function destroySure()
    {
        \DB::beginTransaction();
        try {
            $this->penjualanRepo->destroy($this->idPenjualan);
            \DB::commit();
            $this->reset(['idPenjualan']);
            $this->emit('hideConfirmModal');
            $this->emit('refreshPenjualanTable');
        } catch (ModelNotFoundException $e){
            \DB::rollBack();
        }
    }
}
