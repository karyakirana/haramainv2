<x-atom.table-th width="10%" class="text-center a">
    {{$row->kode}}
</x-atom.table-th>
<x-atom.table-th class="text-center">
    {{$row->customer->nama}}
</x-atom.table-th>
<x-atom.table-th class="text-center">
    {{$row->gudang->nama}}
</x-atom.table-th>
<x-atom.table-th class="text-center">
    {{$row->jenis_bayar}}
</x-atom.table-th>
<x-atom.table-th class="text-center">
    {{tanggalan_format($row->tgl_nota)}}
</x-atom.table-th>
<x-atom.table-th class="text-center">
    {{tanggalan_format($row->tgl_tempo)}}
</x-atom.table-th>
<x-atom.table-th class="text-end">
    {{rupiah_format($row->total_bayar)}}
</x-atom.table-th>
<x-atom.table-th class="text-center">
    <button type="button" class="btn btn-flush btn-active-color-info" wire:click="$emit('setPenjualan',{{$row->id}})"><i class="fas fa-edit fs-4"></i></button>
</x-atom.table-th>
