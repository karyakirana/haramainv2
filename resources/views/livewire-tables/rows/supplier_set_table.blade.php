<x-livewire-tables::bs4.table.cell>
    {{$row->supplierJenis->jenis}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{$row->nama}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{$row->alamat}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    @if($row->telepon == 0|| $row->telepon == '-' ||$row->telepon == null)
    @else
        {{$row->telepon}}
    @endif
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{$row->diskon}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{$row->npwp}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{$row->email}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell>
    {{$row->keterangan}}
</x-livewire-tables::bs4.table.cell>
<x-livewire-tables::bs4.table.cell class="text-center">
    <button type="button" class="btn btn-flush btn-color-gray-500 btn-active-color-info" onclick="Livewire.emit('setSupplier', {{$row->id}})" >set</button>
</x-livewire-tables::bs4.table.cell>
