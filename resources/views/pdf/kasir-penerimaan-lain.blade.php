<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Nomor {{$jurnal_penerimaan_lain->kode}}</title>

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
            Penerimaan Lain
        </div>
        <div class="col-xs-4">

        </div>
        <div class="col-xs-4">
            Surabaya, {{tanggalan_format($jurnal_penerimaan_lain->tgl_penerimaan)}} <br>
        </div>
    </div>
    <div class="row" style="margin-top: 12px">
        <div class="col-xs-8" style="font-size: medium; font-weight: bold">
            Nomor : {{$jurnal_penerimaan_lain->kode}}
        </div>
        <div class="col-xs-4">
        </div>
    </div>

    <table class="table table-bordered">
        <thead style="font-size: small">
        <tr>
            <th>KODE</th>
            <th>Tgl Nota</th>
            <th>Nominal</th>
        </tr>
        </thead>
        <tbody style="font-size: 9pt">
        @php
            $jumlahSubTotal = 0;
        @endphp
        @forelse($jurnal_penerimaan_lain->jurnalTransaksi as $item)
            <tr>
                <td class="text-center">{{$jurnal_penerimaan_lain->kode}}</td>
                <td>{{$jurnal_penerimaan_lain->tgl_penerimaan}}</td>
                <td class="text-right">{{rupiah_format($item->nominal_debet)}}</td>
                @php
                    $jumlahSubTotal += $item->nominal_debet;
                @endphp
            </tr>
        @empty
        @endforelse
        </tbody>
        <tfoot style="font-size: smaller">
        <tr>
            <td colspan="3">Keterangan : {{$jurnal_penerimaan_lain->keterangan}}</td>
        </tr>
        <tr>
            <td colspan="1" style="border-left-color: white!important; border-bottom-color: white!important; border-right-color: white!important;"></td>
            <td colspan="1" class="text-right" style="border-left-color: white!important; border-bottom-color: white!important; font-size: medium!important;">Total</td>
            <td class="text-right">{{rupiah_format($jumlahSubTotal)}}</td>
        </tr>
        </tfoot>
    </table>
    <div class="row" style="margin-top: -10pt">
        <div class="col-xs-3 text-center">
            Penerima
        </div>
        <div class="col-xs-3 text-center">
            Pembayar
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
