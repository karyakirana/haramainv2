<x-atom.table-td class="text-center">{{$row->kode}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{tanggalan_format($row->tgl_jurnal)}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{$row->users->name}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{$row->customer->nama}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{rupiah_format($row->total_bayar)}}</x-atom.table-td>
<x-atom.table-td class="text-center">
    <button type="button" class="btn btn-flush btn-active-color-info" wire:click="edit({{$row->id}})"><i class="fa fa-edit fs-4"></i></button>
    <button type="button" class="btn btn-flush btn-active-color-danger" wire:click="$emit('showModal', {{$row->id}})"><i class="fas fa-indent fs-4"></i></button>
    <button type="button" class="btn btn-flush btn-active-color-danger" wire:click="$emit('destroy', {{$row->id}})"><i class="fas fa-trash fs-4"></i></button>
    <button type="button" class="btn btn-flush btn-active-color-dark" wire:click="print({{$row->id}})" ><i class="fas fa-print"></i></button>
</x-atom.table-td>
