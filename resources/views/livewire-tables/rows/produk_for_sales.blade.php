<x-atom.table-td class="text-center">{{$row->kode_lokal}}</x-atom.table-td>
<x-atom.table-td >{{$row->nama}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{$row->cover}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{$row->hal}}</x-atom.table-td>
<x-atom.table-td class="text-center">{{$row->kategori->kode_lokal}}</x-atom.table-td>
<x-atom.table-td class="text-end">{{rupiah_format($row->harga)}}</x-atom.table-td>
<td class="text-center">
    <button type="button" class="btn btn-flush btn-active-color-info" onclick="setProduk('{{$row->id}}')"><i class="la la-edit fs-2"></i></button>
</td>
