<?php

namespace App\Http\Livewire\Datatables;

use App\Http\Services\Repositories\JurnalPengeluaranRepo;
use App\Models\Keuangan\JurnalPengeluaran;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class KasirPengeluaran extends DataTableComponent
{
    protected string $pageName = 'pengeluaran';
    protected string $tableName = 'pengeluaranList';
    protected $listeners = [
        'refreshPengeluaranTable'=>'$refresh',
        'edit'=>'edit',
        'destroy'=>'destroy',
        'destroyFix'=>'destroyFix'
    ];
    public $pengeluaran_id;

    public function columns(): array
    {
        return [
            Column::make('ID', 'kode')
                ->sortable()
                ->searchable()
                ->addClass('hidden md:table-cell')
                ->selected(),
            Column::make('Pembuat', 'users.name')
                ->sortable()
                ->searchable(),
            Column::make('Tgl Pengeluaran', 'tgl_pengeluaran')
                ->sortable()
                ->searchable(),
            Column::make('Nominal', 'nominal')
                ->sortable()
                ->searchable(),
            Column::make('Keterangan', 'keterangan')
                ->sortable()
                ->searchable(),
            Column::make('Action', 'actions')
                ->sortable()
                ->searchable(),
        ];
    }

    public function query(): Builder
    {
        return JurnalPengeluaran::query()
            ->with('users')
            ->where('active_cash', session('ClosedCash'))
            ->latest('kode');
    }

    public function setTableRowClass($row): ?string
    {
        return 'align-middle';
    }

    public function edit($id)
    {
        return redirect()->to('keuangan/kasir/pengeluaran/edit/'.$id);
    }


    public function print($id)
    {
        return redirect()->to(''.$id);
    }

    public function destroy($id)
    {
        $this->pengeluaran_id = $id;
        $this->emit('showConfirmModal');
    }

    public function destroyFix()
    {
        (new JurnalPengeluaranRepo())->destroy($this->pengeluaran_id);
        $this->reset(['pengeluaran_id']);
        $this->emit('hideConfirmModal');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.kasir_pengeluaran';
    }
}
