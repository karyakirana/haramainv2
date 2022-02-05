<x-atom.table-td class="text-center">{{$row->kode}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{$row->nama}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{$row->alamat}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{$row->npwp}}</x-atom.table-td>
<x-atom.table-td class="text-end">{{rupiah_format($row->maximal)}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{$row->keterangan}}</x-atom.table-td>
<x-atom.table-td class="text-center">
    <x-atom.button-edit onclick="Livewire.emit('edit', {{$row->id}})"/>
    <x-atom.button-delete wire:click="destroy({{$row->id}})"/>
</x-atom.table-td>
