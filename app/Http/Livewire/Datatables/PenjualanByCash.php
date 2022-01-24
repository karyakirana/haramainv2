<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Penjualan\Penjualan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PenjualanByCash extends DataTableComponent
{
    protected string $pageName = 'penjualan';
    protected string $tableName = 'penjualanByCash';

    public $customerId;

    protected $listeners = [
        'showPenjualanModal'=>'setCustomerId'
    ];

    public function setCustomerId($id)
    {
        $this->customerId = $id;
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'kode')
                ->sortable()
                ->searchable(),
            Column::make('Customer', 'customer.nama')
                ->sortable()
                ->searchable(),
            Column::make('Gudang', 'gudang.nama')
                ->sortable()
                ->searchable(),
            Column::make('Jenis')
                ->sortable(),
            Column::make('Tgl Nota')
                ->sortable(),
            Column::make('Tgl Tempo')
                ->sortable(),
            Column::make('Total Bayar')
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        if ($this->customerId)
        {
            return Penjualan::query()
                ->where('customer_id', $this->customerId)
                ->where('status_bayar', 'belum')
                ->where(function ($query){
                    $query->where('jenis_bayar', 'Tunai')
                        ->orWhere('jenis_bayar', 'cash');
                })->latest();
        }
        return Penjualan::query()
            ->where('status_bayar', 'belum')
            ->where(function ($query){
                $query->where('jenis_bayar', 'Tunai')
                    ->orWhere('jenis_bayar', 'cash');
            })->latest();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.penjualan_by_cash';
    }
}
