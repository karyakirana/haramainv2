<x-atom.table-td>
    {{$row->kode}}
</x-atom.table-td>
<x-atom.table-td>
    {{$row->customer->nama}}
</x-atom.table-td>
<x-atom.table-td>
    {{$row->users->name}}
</x-atom.table-td>
<x-atom.table-td>
    {{$row->total_bayar}}
</x-atom.table-td>
<x-atom.table-td>
    {{$row->keterangan}}
</x-atom.table-td>
<x-atom.table-td>
    <x-atom.button-edit wire:click="edit({{$row->id}})"/>
    <x-atom.button-delete wire:click="destroy({{$row->id}})"/>
</x-atom.table-td>
