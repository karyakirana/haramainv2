@if (!$columnSelect || ($columnSelect && $this->isColumnSelectEnabled('gudang')))
    <td class="text-center">
        {{$row->gudang->nama}}
    </td>
@endif
@if (!$columnSelect || ($columnSelect && $this->isColumnSelectEnabled('produk')))
    <td>
        {{$row->produk->nama}} <br>
        {{$row->produk->kategori->kode_lokal}} - {{$row->produk->kategoriHarga->nama}} {{$row->produk->cover ? '- '.$row->produk->cover : ''}}
    </td>
@endif
@if (!$columnSelect || ($columnSelect && $this->isColumnSelectEnabled('stock_opname')))
    <td class="text-end">
        {{rupiah_format($row->stock_opname)}}
    </td>
@endif
@if (!$columnSelect || ($columnSelect && $this->isColumnSelectEnabled('stock_masuk')))
    <td class="text-end">
        {{rupiah_format($row->stock_masuk)}}
    </td>
@endif
@if (!$columnSelect || ($columnSelect && $this->isColumnSelectEnabled('stock_keluar')))
    <td class="text-end">
        {{rupiah_format($row->stock_keluar)}}
    </td>
@endif
@if (!$columnSelect || ($columnSelect && $this->isColumnSelectEnabled('stock_sisa')))
    <td class="text-end">
{{--        {{$row->stock_opname + $row->stock_masuk - $row->stock_keluar}}--}}
        {{rupiah_format($row->stock_sisa)}}
    </td>
@endif
