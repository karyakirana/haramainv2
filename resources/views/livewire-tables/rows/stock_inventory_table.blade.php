
<x-livewire-tables::bs5.table.cell width="10%" class="text-center hidden md:table-cell">
    {{$row->produk->kode_lokal}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-left">
    {{$row->jenis}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-left">
    {{$row->gudang->nama}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-left">
    {{$row->produk->nama}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{rupiah_format($row->stock_awal)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{rupiah_format($row->stock_opname)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{rupiah_format($row->stock_masuk)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{rupiah_format($row->stock_keluar)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{rupiah_format($row->stock_lost)}}
</x-livewire-tables::bs5.table.cell>
<x-livewire-tables::bs5.table.cell class="text-center">
    {{rupiah_format($row->stock_opname + $row->stock_masuk - $row->stock_keluar)}}
</x-livewire-tables::bs5.table.cell>
