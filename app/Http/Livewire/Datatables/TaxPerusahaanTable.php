<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Master\Perusahaan;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class TaxPerusahaanTable extends DataTableComponent
{
    protected $listeners = [
        'refreshTaxPerusahaan'=>'$refresh',
        'destroy'=>'destroy',
        'destroyFix'=>'destroyFix',
    ];

    public $perusahaan_id;

    public function columns(): array
    {
        return [
            Column::make('Kode'),
            Column::make('Nama'),
            Column::make('Alamat'),
            Column::make('NPWP'),
            Column::make('Maksimal'),
            Column::make('Keterangan'),
            Column::make(''),
        ];
    }

    public function destroy($id)
    {
        $this->perusahaan_id = $id;
        $this->emit('showConfirmModal');
    }

    public function destroyFix()
    {
        Perusahaan::destroy($this->perusahaan_id);
        $this->emit('hideConfirmModal');
        $this->emit('refreshTaxPerusahaan');
    }

    public function query(): Builder
    {
        return Perusahaan::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.tax_perusahaan_table';
    }
}
