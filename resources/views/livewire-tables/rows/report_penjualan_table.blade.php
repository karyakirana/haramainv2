<x-atom.table-td>
    {{$row->kode}}
</x-atom.table-td>
<x-atom.table-td>
    {{ucfirst($row->customer->nama)}}
</x-atom.table-td>
<x-atom.table-td>
    {{tanggalan_format($row->tgl_nota)}}
</x-atom.table-td>
<x-atom.table-td>
    @if($row->jenis_bayar == 'tunai'||$row->jenis_bayar == 'Tunai'||$row->jenis_bayar == 'cash')
        Tunai
    @else
        Tempo
    @endif
</x-atom.table-td>
<x-atom.table-td>
    @if($row->tgl_tempo)
        {{tanggalan_format($row->tgl_tempo)}}
    @endif
</x-atom.table-td>
<x-atom.table-td>
    {{ucfirst($row->users->name)}}
</x-atom.table-td>
<x-atom.table-td>
    {{rupiah_format($row->total_bayar)}}
</x-atom.table-td>
<x-atom.table-td class="text-center">
    <button type="button" class="btn btn-flush btn-active-color-danger" wire:click="$emit('showModal', {{$row->id}})"><i class="fas fa-indent"></i></button>
</x-atom.table-td>
