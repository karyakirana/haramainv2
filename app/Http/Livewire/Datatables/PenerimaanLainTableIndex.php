<?php

namespace App\Http\Livewire\Datatables;

use App\Http\Services\Repositories\JurnalPenerimaanRepo;
use App\Models\Keuangan\JurnalPenerimaan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PenerimaanLainTableIndex extends DataTableComponent
{

    protected $listeners = [
        'refreshPenerimaanLainTable'=>'$refresh',
        'edit'=>'edit',
        'destroy'=>'destroy',
        'destroyFix'=>'destroyFix'
    ];

    public $penerimaan_lain_id;

    public function columns(): array
    {
        return [
            Column::make('Kode', 'kode'),
            Column::make('Tanggal', 'tgl_penerimaan'),
            Column::make('Pembuat', 'users.name'),
            Column::make('Nominal', 'nominal'),
            Column::make('Keterangan'),
        ];
    }

    public function query(): Builder
    {
        return JurnalPenerimaan::query()
            ->with(['users'])
            ->where('active_cash', session('ClosedCash'));
    }

    public function setTableRowClass($row): ?string
    {
        return 'align-middle';
    }

    public function rowView() : string
    {
        return 'livewire-tables.rows.penerimaan_lain_table_index';
    }

    public function edit($id)
    {
        return redirect()->to('kasir/penerimaan/lain/edit/'.$id);
    }


    public function print($id)
    {
        return redirect()->to('kasir/penerimaan/lain/print/'.$id);
    }

    public function destroy($id)
    {
        $this->penerimaan_lain_id = $id;
        $this->emit('showConfirmModal');
    }

    public function destroyFix()
    {
        (new JurnalPenerimaanRepo())->destroy($this->penerimaan_lain_id);
        $this->reset(['penerimaan_lain_id']);
        $this->emit('hideConfirmModal');
    }
}
