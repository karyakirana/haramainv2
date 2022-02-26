<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Keuangan\SaldoHutangPembelian;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class SaldoPiutangPembelian extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make('Kode', 'supplierJenis.jenis')
                ->searchable()
                ->sortable(),
            Column::make('Nama', 'supplier.nama')
                ->searchable()
                ->sortable(),
            Column::make('Tgl Awal', 'tgl_awal'),
            Column::make('Tgl Akhir', 'tgl_akhir'),
            Column::make('Saldo', 'saldo'),
            Column::make('Action' ),
        ];
    }

    public function query(): Builder
    {
        return SaldoHutangPembelian::query();
    }

    public function edit($id)
    {
        return redirect()->to(''.$id);
    }


    public function print($id)
    {
        return redirect()->to(''.$id);
    }

    public function destroy($id)
    {
        $this->emit('showConfirmModal');
    }

    public function destroyFix()
    {
        $this->emit('hideConfirmModal');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.saldo_piutang_pembelian';
    }
}
