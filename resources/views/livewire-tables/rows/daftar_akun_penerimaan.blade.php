<x-livewire-tables::bs5.table.cell width="10%" class="text-center">
    {{$row->akunKategori->deskripsi}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell width="10%" class="text-center">
    {{$row->akunTipe->deskripsi}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell width="10%" class="text-center">
    {{$row->kode}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell width="10%" class="text-center">
    {{$row->deskripsi}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center" width="10%">
    <button type="button" class="btn btn-flush btn-active-color-info btn-icon" wire:click="$emit('setAkun',{{$row->id}})"><i class="fas fa-pen-nib fs-2"></i></button>
</x-livewire-tables::bs5.table.cell>
