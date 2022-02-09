<x-atom.table-td class="text-center">{{$row->kode}}</x-atom.table-td>
<x-atom.table-td >{{$row->nama}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{$row->telepon}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{$row->alamat}}</x-atom.table-td>
<td class="text-center">
    <button type="button" class="btn btn-flush btn-active-color-info" onclick="Livewire.emit('setPegawai','{{$row->id}}')"><i class="la la-edit fs-2"></i></button>
</td>
