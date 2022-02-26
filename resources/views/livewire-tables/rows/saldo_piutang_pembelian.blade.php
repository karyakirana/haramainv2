<x-livewire-tables::bs5.table.cell width="10%" class="text-center hidden md:table-cell">
    {{$row->supplierJenis->jenis}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-left">
    {{$row->supplier->nama}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{$row->tgl_awal}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{$row->tgl_akhir}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-left">
    {{$row->saldo}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell width="15%" class="text-center">
    <x-atom.button-edit wire:click="edit({{$row->id}})"/>
    <x-atom.button-delete wire:click="destroy({{$row->id}})"/>
    <x-atom.button-print wire:click="print({{$row->id}})"/>
</x-livewire-tables::bs5.table.cell>
