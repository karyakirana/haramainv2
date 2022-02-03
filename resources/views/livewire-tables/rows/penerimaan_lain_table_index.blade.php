<td class="text-center" width="15%">
    {{$row->kode}}
</td>
<td class="text-center" width="15%">
    {{tanggalan_format($row->tgl_penerimaan)}}
</td>
<td class="text-center" width="15%">
    {{ucfirst($row->users->name)}}
</td>
<td class="text-end" width="15%">
    {{rupiah_format($row->nominal)}}
</td>
<td width="20%">
    {{$row->keterangan}}
</td>
<td class="text-center" width="15%">
    <x-atom.button-edit wire:click="edit({{$row->id}})"/>
    <x-atom.button-delete wire:click="destroy({{$row->id}})"/>
    <x-atom.button-print wire:click="print({{$row->id}})"/>
</td>
