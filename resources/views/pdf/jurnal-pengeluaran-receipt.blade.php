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
            Kas Masuk
        </div>
        <div class="col-xs-4">
        </div>
        <div class="col-xs-4">
            Surabaya, {{tanggalan_format($data->tgl_pengeluaran)}} <br>
        </div>
    </div>
    <div class="row" style="margin-top: 12px">
        <div class="col-xs-8" style="font-size: medium; font-weight: bold">
            Nomor : {{$data->kode}}
        </div>
        <div class="col-xs-4">
        </div>
    </div>
    @foreach($data->jurnalTransaksi as $item)
        <div class="row">
            <div class="col-xs-2">
                @if($item->nominal_debet)
                    Dari Akun
                @else
                    Ke Akun
                @endif
            </div>
            <div class="col-xs-1">:</div>
            <div class="col-xs-5">
                {{$item->akun->deskripsi}}
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-xs-2">
            Uang Sejumlah
        </div>
        <div class="col-xs-1">:</div>
        <div class="col-xs-6">
            {{terbilang($data->nominal)}}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-2">
            Keperluan
        </div>
        <div class="col-xs-1">:</div>
        <div class="col-xs-5">
            {{$data->keterangan}}
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div style="border: solid #0b0b10 !important; font-size: medium; font-weight: bold; margin-top: 10pt; margin-bottom: 10pt">
                <p style="margin-left: 10pt; margin-top: 5pt">Rp. {{rupiah_format($data->nominal)}}</p>
            </div>

        </div>
    </div>

    <div class="row">
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

    </div>
</div>
</body>
</html>
