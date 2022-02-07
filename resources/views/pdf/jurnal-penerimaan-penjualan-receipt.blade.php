<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Nomor {{$jurnal_penerimaan->kode}}</title>

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
        #head-nota th{
            font-size: 9pt;
            letter-spacing: 2pt;
        }
    </style>
</head>
<body>
<div class="container">
    <table class="table table-bordered" style="margin-bottom: 0pt!important;">
        <tr>
            <td rowspan="2" style="width: 30%">
                Diterima dari : <br><br>
                {{$jurnal_penerimaan->customer->nama ?? ''}}
            </td>
            <td rowspan="2" class="text-center"
                style="vertical-align: middle!important; font-size: 25pt; font-weight: bolder; width: 40%"
            >
                BUKTI KAS MASUK
            </td>
            <td style="width: 30%">
                <div class="row">
                    <div class="col-xs-4">
                        <p>Nomor :</p>
                    </div>
                    <div class="col-xs-8 text-right">
                        {{$jurnal_penerimaan->kode}}
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="row">
                    <div class="col-xs-4">
                        <p>Tanggal :</p>
                    </div>
                    <div class="col-xs-8 text-right">
                        {{tanggalan_format($jurnal_penerimaan->tgl_penerimaan)}}
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <table class="table table-bordered" style="margin-top: 0!important; border-top: none!important; margin-bottom: 0pt;">
        <tr id="head-nota">
            <th width="10%" style="border-top: none!important; border-bottom: none!important;"></th>
            <th width="15%" style="border-top: none!important;">Perkiraan</th>
            <th colspan="2" width="50%" style="border-top: none!important;">Uraian</th>
            <th class="text-center" style="border-top: none!important; width: 20%">Jumlah</th>
        </tr>
        @foreach($jurnal_penerimaan->jurnalPenerimaanDetail as $item)
            @if($item->penjualan_id)
                <tr>
                    <td style="border-bottom: none!important; border-top: none!important;"></td>
                    <td class="text-center"></td>
                    <td colspan="2">{{$item->penjualan->kode}}</td>
                    <td class="text-right">{{rupiah_format($jurnal_penerimaan->total_bayar)}}</td>
                </tr>
            @endif
        @endforeach
        <tr>
            <td colspan="4" style="font-size: 9pt">
                Terbilang : {{ucwords(terbilang($jurnal_penerimaan->total_bayar))}}
            </td>
            <td>
                <div class="row" style="font-size: 9pt">
                    <div class="col-xs-4">Total :</div>
                    <div class="col-xs-8 text-right">{{rupiah_format($jurnal_penerimaan->total_bayar)}}</div>
                </div>
            </td>
        </tr>
    </table>
    <table class="table table-bordered">
        <tr>
            <td rowspan="2">Catatan</td>
            <th style="width: 17%">Pembukuan</th>
            <th style="width: 17%">Mengetahui</th>
            <th style="width: 17%">Kasir</th>
            <th style="width: 17%">Penyetor</th>
        </tr>
        <tr style="height: 70pt">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr></tr>
    </table>
</div>
</body>
</html>
