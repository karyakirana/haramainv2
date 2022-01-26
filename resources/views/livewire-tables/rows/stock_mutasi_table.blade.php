
<x-livewire-tables::bs5.table.cell width="20%" class="text-center hidden md:table-cell">
    {{$row->kode}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-left">
    {{$row->gudangAsal->nama}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-left">
    {{$row->gudangTujuan->nama}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-left">
    {{$row->users->name??''}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell width="20%" class="text-center">
    {{tanggalan_format($row->tgl_mutasi)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell width="10%" class="text-center">
    @if($row->jenis_mutasi=='baik_baik')
        <button type="button" class="btn btn-flush btn-active-color-info" wire:click="edit({{$row->id}})"><i class="far fa-edit"></i></button>
    @elseif($row->jenis_mutasi=='baik_rusak')
        <button type="button" class="btn btn-flush btn-active-color-info" wire:click="editRusak({{$row->id}})"><i class="far fa-edit"></i></button>
    @else
        <button type="button" class="btn btn-flush btn-active-color-info" wire:click="editRusakRusak({{$row->id}})"><i class="far fa-edit"></i></button>
    @endif
    <button type="button" class="btn btn-flush btn-active-color-danger" wire:click="$emit('showModal', {{$row->id}})"><i class="fas fa-indent"></i></button>
    <button type="button" class="btn btn-flush btn-active-color-dark" wire:click="print({{$row->id}})" ><i class="fas fa-print"></i></button>
</x-livewire-tables::bs5.table.cell>
