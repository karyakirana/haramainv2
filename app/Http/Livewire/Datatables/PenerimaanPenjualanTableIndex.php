<?php

namespace App\Http\Livewire\Datatables;

use App\Http\Services\Repositories\JurnalPenerimaanPenjualanRepo;
use App\Models\Keuangan\JurnalPenerimaanPenjualan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PenerimaanPenjualanTableIndex extends DataTableComponent
{

    protected $listeners = [
        'refreshPenerimaanPenjualanTable'=>'$refresh',
        'edit'=>'edit',
        'destroy'=>'destroy',
        'destroyFix'=>'destroyFix'
    ];

    public $penerimaan_penjualan_id;

    public function columns(): array
    {
        return [
            Column::make('Kode'),
            Column::make('Customer'),
            Column::make('Pembuat'),
            Column::make('Total Bayar'),
            Column::make('Keterangan'),
            Column::make(''),
        ];
    }

    public function query(): Builder
    {
        return JurnalPenerimaanPenjualan::query()
            ->where('active_cash', session('ClosedCash'));
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.penerimaan_penjualan_table_index';
    }

    public function edit($id)
    {
        return redirect()->to('keuangan/jurnal/penerimaan/edit/'.$id);
    }

    public function destroy($id)
    {
        $this->penerimaan_penjualan_id = $id;
        $this->emit('showConfirmModal');
    }

    public function destroyFix()
    {
        (new JurnalPenerimaanPenjualanRepo())->rollback($this->penerimaan_penjualan_id);
        $this->emit('hideConfirmModal');
        $this->emit('reloadTable');
    }
}
