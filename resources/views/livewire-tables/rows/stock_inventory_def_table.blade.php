@if (!$columnSelect || ($columnSelect && $this->isColumnSelectEnabled('gudang')))
    <td>
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
    <td>
        {{$row->stock_opname}}
    </td>
@endif
@if (!$columnSelect || ($columnSelect && $this->isColumnSelectEnabled('stock_masuk')))
    <td>
        {{$row->stock_masuk}}
    </td>
@endif
@if (!$columnSelect || ($columnSelect && $this->isColumnSelectEnabled('stock_keluar')))
    <td>
        {{$row->stock_keluar}}
    </td>
@endif
@if (!$columnSelect || ($columnSelect && $this->isColumnSelectEnabled('stock_sisa')))
    <td>
{{--        {{$row->stock_opname + $row->stock_masuk - $row->stock_keluar}}--}}
        {{$row->stock_sisa}}
    </td>
@endif
