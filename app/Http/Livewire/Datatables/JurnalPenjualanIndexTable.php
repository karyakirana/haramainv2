<?php

namespace App\Http\Livewire\Datatables;

use App\Http\Services\Repositories\JurnalSetPiutangRepo;
use App\Models\Keuangan\JurnalPenjualan;
use App\Models\Master\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class JurnalPenjualanIndexTable extends DataTableComponent
{
    public $jurnal_penjualan_id;

    protected $listeners = [
        'refreshDatatables'=>'$refresh',
        'destroy'=>'destroy',
        'confirmationDestroy'=>'confirmationDestroy'
    ];

    public function setTableClass()
    {
        return 'table fs-5 gs-7 table-striped border';
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'kode')
                ->sortable()
                ->searchable()
                ->addClass('text-center'),
            Column::make('Tanggal', 'tgl_jurnal')
                ->sortable()
                ->searchable()
                ->addClass('text-center'),
            Column::make('Pembuat', 'users.name')
                ->searchable()
                ->addClass('text-center'),
            Column::make('Customer', 'customer.name')
                ->sortable(function(Builder $query, $direction) {
                    return $query->orderBy(Customer::query()
                        ->select('nama')
                        ->whereColumn('jurnal_penjualan.customer_id', 'customer.id'), $direction);
                })
                ->searchable()
                ->addClass('text-center'),
            Column::make('Total Bayar')
                ->sortable()
                ->addClass('text-center'),
            Column::make('')
                ->addClass('text-center'),
        ];
    }

    public function query(): Builder
    {
        return JurnalPenjualan::query()
            ->with(['jurnalPenjualanDetail', 'customer', 'users'])
            ->where('active_cash', session('ClosedCash'))
            ->latest();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.jurnal_penjualan_index_table';
    }

    /**
     * additional for button
     */
    public function edit($id)
    {
        return redirect()->to('keuangan/kasir/set/piutang/transaksi/'.$id);
    }

    public function destroy($id)
    {
        $this->jurnal_penjualan_id = $id;
        $this->emit('showConfirmModal');
    }

    public function confirmationDestroy()
    {
        \DB::beginTransaction();
        try {
            (new JurnalSetPiutangRepo())->destroy($this->jurnal_penjualan_id);
            \DB::commit();
            $this->emit('refreshDatatables');
            $this->reset(['jurnal_penjualan_id']);
            $this->emit('hideConfirmModal');
        } catch (\Exception $e){
            \DB::rollBack();
        }
    }
}
