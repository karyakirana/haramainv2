<x-atom.table-td>{{$row->perusahaan->nama}}</x-atom.table-td>
<x-atom.table-td>{{$row->perusahaan->npwp}}</x-atom.table-td>
<x-atom.table-td class="text-end">{{rupiah_format($row->total_keseluruhan)}}</x-atom.table-td>
