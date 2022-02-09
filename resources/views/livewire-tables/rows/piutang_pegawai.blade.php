<td class="text-center" width="15%">
    {{$row->kode}}
</td>
<td class="text-center">
    {{$row->pegawai->nama}}
</td>
<td class="text-center">
    {{ucfirst($row->users->name)}}
</td>
<td class="text-center" width="10%">
    {{$row->status}}
</td>
<td class="text-center" width="10%">
    {{tanggalan_format($row->tgl_piutang)}}
</td>
<td class="text-end" width="10%">
    {{rupiah_format($row->nominal)}}
</td>
<td class="text-center" width="15%">
    {{$row->keterangan}}
</td>
<td class="text-center" width="15%">
    <x-atom.button-edit wire:click="edit({{$row->id}})"/>
    <x-atom.button-delete wire:click="destroy({{$row->id}})"/>
    <x-atom.button-print wire:click="print({{$row->id}})"/>
</td>
