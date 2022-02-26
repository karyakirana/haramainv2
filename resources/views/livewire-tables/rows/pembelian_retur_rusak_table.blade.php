
<x-livewire-tables::bs5.table.cell width="10%" class="text-center hidden md:table-cell">
    {{$row->kode}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-left">
    {{$row->supplier->nama}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell width="10%" class="text-center">
    {{tanggalan_format($row->tgl_nota)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell width="10%" class="text-center">
    {{tanggalan_format($row->tgl_tempo)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell width="10%" class="text-center">
    {{$row->status_bayar}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell width="13%" class="text-end">
    {{rupiah_format($row->total_bayar)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell width="10%" class="text-center">
    <button type="button" class="btn btn-flush btn-active-color-info" wire:click="edit({{$row->id}})"><i class="far fa-edit"></i></button>
    <button type="button" class="btn btn-flush btn-active-color-danger" wire:click="$emit('showModal', {{$row->id}})"><i class="fas fa-indent"></i></button>
    <button type="button" class="btn btn-flush btn-active-color-dark" wire:click="print({{$row->id}})" ><i class="fas fa-print"></i></button>
</x-livewire-tables::bs5.table.cell>
