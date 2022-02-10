<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Nomor {{$data->kode}}</title>

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
            font-size: 16pt;
        }
        th{
            align-content: center;
            text-align: center;
        }
        body{
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            letter-spacing: 1px;
            font-size: 12pt;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row" style="font-size: 14pt">
        <div class="col-xs-4">
            Nomor : {{$data->kode}}
        </div>
        <div class="col-xs-4">
        </div>
        <div class="col-xs-4">
            Surabaya, {{tanggalan_format($data->tgl_pengeluaran)}} <br>
        </div>
    </div>
    <div class="row" style="margin-top: 12px; font-size: 20pt">
        <div class="col-xs-12 text-center" style="font-size: medium; font-weight: bolder;">
            <u><h3>KAS KELUAR</h3></u>
        </div>
    </div>
    <table class="table table-bordered" style="margin-bottom: 0pt!important;">
        <td class="row" style="margin-top: 15pt; font-size: 16pt">
            <div class="col-xs-2">Untuk</div>
            <div class="col-xs-1">:</div>
            <div class="col-xs-4 text-left">{{$data->tujuan}}</div>
        </td>
    </table>
    <table class="table table-bordered" style="margin-bottom: 0pt!important;">
        <td class="row" style="margin-top: 0pt; font-size: 16pt">
            <div class="col-xs-2">Keperluan</div>
            <div class="col-xs-1">:</div>
            <div class="col-xs-9 row">
                @foreach($data->jurnalTransaksi as $row)
                    @if($row->nominal_debet)
                        <div class="col-xs-6 text-left">
                            {{$row->keterangan}}
                        </div>
                        <div class="col-xs-6 text-right" style="margin-right: -100pt!important;">
                           {{rupiah_format($row->nominal_debet)}}
                        </div>
                    @endif
                @endforeach
            </div>

        </td>
    <table class="table table-bordered" style="margin-bottom: 0pt!important;">
        <tr>
            <td class="row" colspan="1" style="font-size: 14pt">
                <div class="col-xs-3">Terbilang :</div>
                <div class="col-xs-9">
                    {{ucwords(terbilang($data->nominal))}} Rupiah
                </div>
            </td>
            <td width="30%">
                <div class="row" style="font-size: 14pt">
                    <div class="col-xs-5">Total :</div>
                    <div class="col-xs-7 text-right" style="margin-left: -47px" >Rp.{{rupiah_format($data->nominal)}}</div>
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
                <th style="width: 17%">Penerima</th>
            </tr>
            <tr style="height: 70pt">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr></tr>
        </table>


{{--    <div class="row" style="margin-top: 15pt; font-size: 16pt">--}}
{{--        <div class="col-xs-2">Untuk</div>--}}
{{--        <div class="col-xs-1">:</div>--}}
{{--        <div class="col-xs-4">{{$data->tujuan}}</div>--}}
{{--    </div>--}}
{{--    <div class="row" style="margin-top: 7pt; font-size: 16pt">--}}
{{--        <div class="col-xs-2">Keperluan</div>--}}
{{--        <div class="col-xs-1">:</div>--}}
{{--        @foreach($data->jurnalTransaksi as $row)--}}
{{--            @if($row->nominal_debet)--}}
{{--                <div class="col-xs-4">--}}
{{--                    {{$row->keterangan}}--}}
{{--                </div>--}}
{{--                <div class="col-xs-4">--}}
{{--                    Rp. {{rupiah_format($row->nominal_debet)}}--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--    @if($data->jurnalTransaksi->count() > 2)--}}
{{--        <div class="row" style="margin-top: 7pt; font-size: 16pt">--}}
{{--            <div class="col-xs-3"></div>--}}
{{--            <div class="col-xs-4">--}}
{{--                Total Keseluruhan--}}
{{--            </div>--}}
{{--            <div class="col-xs-4">--}}
{{--                Rp. {{rupiah_format($data->total_bayar)}}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    <div class="row" style="margin-top: 7pt; font-size: 16pt">--}}
{{--        <div class="col-xs-2">Terbilang</div>--}}
{{--        <div class="col-xs-1">:</div>--}}
{{--        <div class="col-xs-4">--}}
{{--            <div style="border: 2px solid!important; padding: 4pt">--}}
{{--                {{ucwords(terbilang($data->nominal))}} Rupiah--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row" style="margin-top: 15pt; margin-bottom: 15pt">--}}
{{--        <div class="col-xs-12" >--}}
{{--            <div style="border: 1px solid!important;"></div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row" style="font-size: 16pt">--}}
{{--        <div class="col-xs-5 text-center">--}}
{{--            Mengetahui--}}
{{--        </div>--}}
{{--        <div class="col-xs-4 text-center">--}}
{{--            Penerima--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row" style="margin-top: 50pt; font-size: 16pt">--}}
{{--        <div class="col-xs-5 text-center">--}}
{{--            (&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)--}}
{{--        </div>--}}
{{--        <div class="col-xs-4 text-center">--}}
{{--            (&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div style="margin-top: 10pt">--}}

{{--    </div>--}}
</div>
</body>
</html>
