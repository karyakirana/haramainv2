<?php

namespace App\Http\Livewire\Datatables;

use App\Models\Keuangan\JurnalPiutangPegawai;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class PiutangPegawai extends DataTableComponent
{

    protected $listeners = [
        'refreshPiutangPegawaiTable'=>'$refresh',
        'edit'=>'edit',
        'destroy'=>'destroy',
        'destroyFix'=>'destroyFix'
    ];

    public $piutang_id;
    public function columns(): array
    {
        return [
            Column::make('Kode', 'kode'),
            Column::make('Pegawai', 'pegawai.nama'),
            Column::make('Pembuat', 'users.name'),
            Column::make('Status', 'status'),
            Column::make('Tanggal', 'tgl_piutang'),
            Column::make('Nominal', 'nominal'),
            Column::make('Keterangan', 'keterangan'),
            Column::make(''),
        ];
    }

    public function query(): Builder
    {
        return JurnalPiutangPegawai::query()
            ->with(['pegawai', 'users'])
            ->where('active_cash', session('ClosedCash'));
    }

    public function edit($id)
    {
        return redirect()->to('keuangan/kasir/piutang/pegawai/trans/'.$id);
    }


    public function print($id)
    {
        return redirect()->to(''.$id);
    }

    public function destroy($id)
    {
        $this->piutang_id = $id;
        $this->emit('showConfirmModal');
    }

    public function destroyFix()
    {
        $this->emit('hideConfirmModal');
    }
    public function rowView(): string
    {
        return 'livewire-tables.rows.piutang_pegawai';
    }
}
