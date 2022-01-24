<x-livewire-tables::bs5.table.cell width="10%" class="text-center">
    {{$row->kode}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{$row->customer->nama}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{$row->gudang->nama}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{$row->jenis_bayar}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{tanggalan_format($row->tgl_nota)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{tanggalan_format($row->tgl_tempo)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-end">
    {{rupiah_format($row->total_bayar)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    <button type="button" class="btn btn-flush btn-active-color-info" wire:click="$emit('setPenjualan',{{$row->id}})">set</button>
</x-livewire-tables::bs5.table.cell>
