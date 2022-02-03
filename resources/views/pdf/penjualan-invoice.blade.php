<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Nomor {{$penjualan->kode}}</title>

{{--    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">--}}
    <!-- Styles -->
    <link rel="stylesheet" href="{{ public_path('css\bootstrap.css') }}" media="all" />
{{--    <link rel="stylesheet" href="{{ public_path('css\bootstrap.css') }}" media="all" />--}}
{{--    <link rel="stylesheet" type="text/css" href="{{ public_path('css\app.css') }}">--}}
{{--    <link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />--}}
{{--    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" media="all"/>--}}
{{--    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" media="all" />--}}

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <style>
        .table, th, td{
            border-color: #0b0b10!important;
            font-size: 7.5pt;
        }
        th{
            align-content: center;
            text-align: center;
        }
        body{
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            letter-spacing: 1px;
            font-size: 9pt;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-4">
                Nota Penjualan
            </div>
            <div class="col-xs-4">
                Colly =
            </div>
            <div class="col-xs-4">
                Surabaya, {{tanggalan_format($penjualan->tgl_nota)}} <br>
                Kepada Yth, {{$penjualan->customer->nama}} <br>
                {{$penjualan->customer->alamat}}
            </div>
        </div>
        <div class="row" style="margin-top: 12px">
            <div class="col-xs-8" style="font-size: medium; font-weight: bold">
                Nomor : {{$penjualan->kode}}
            </div>
            <div class="col-xs-4">
                @if($penjualan->tgl_tempo)
                    Jatuh Tempo : {{tanggalan_format($penjualan->tgl_tempo)}}
                @endif
            </div>
        </div>

        <table class="table table-bordered">
            <thead style="font-size: small">
                <tr>
                    <th>KODE</th>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Disc (%)</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody style="font-size: 9pt">
            @php
                $jumlahSubTotal = 0;
            @endphp
                @forelse($penjualan->penjualanDetail as $item)
                    <tr>
                        <td class="text-center">{{$item->produk->kode_lokal}}</td>
                        <td>{{$item->produk->nama}}</td>
                        <td class="text-center">{{$item->jumlah}}</td>
                        <td class="text-right">{{rupiah_format($item->harga)}}</td>
                        <td class="text-center">{{$item->diskon}}</td>
                        <td class="text-right">{{rupiah_format($item->sub_total)}}</td>
                        @php
                            $jumlahSubTotal += $item->sub_total;
                        @endphp
                    </tr>
                @empty
                @endforelse
            </tbody>
            <tfoot style="font-size: smaller">
                <tr>
                    <td colspan="6">Keterangan : {{$penjualan->keterangan}}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-color: white!important;"></td>
                    <td colspan="2">Sub Total</td>
                    <td class="text-right">{{rupiah_format($jumlahSubTotal)}}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-color: white!important;"></td>
                    <td colspan="2">Biaya Lain</td>
                    <td class="text-right">{{rupiah_format($penjualan->biaya_lain)}}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-color: white!important;"></td>
                    <td colspan="2">Total Bayar</td>
                    <td class="text-right">{{rupiah_format($penjualan->total_bayar)}}</td>
                </tr>
            </tfoot>
        </table>
        <div class="row" style="margin-top: -80pt">
            <div class="col-xs-3 text-center">
                Disiapkan Oleh
            </div>
            <div class="col-xs-3 text-center">
                Disetujui Oleh
            </div>
        </div>
        <div class="row" style="margin-top: 50pt">
            <div class="col-xs-3 text-center">
                (&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)
            </div>
            <div class="col-xs-3 text-center">
                (&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)
            </div>
        </div>
        <div style="margin-top: 10pt">
            NB: Barang tidak dapat dikembalikan kecuali Rusak / Perjanjian sebelumnya.
        </div>
    </div>
</body>
</html>
