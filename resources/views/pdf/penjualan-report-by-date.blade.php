<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Penjualan</title>

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
        .page-footer{
            font-size: 7pt;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Daftar Penjualan</h2>
    <h3 class="text-center">{{tanggalan_format($startDate)}} s/d {{tanggalan_format($endDate)}}</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Customer</th>
                <th>Tgl Nota</th>
                <th>Jenis</th>
                <th>Tgl Tempo</th>
                <th>Status</th>
                <th>Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan as $item)
                <tr>
                    <x-atom.table-td>{{$item->kode}}</x-atom.table-td>
                    <x-atom.table-td>{{$item->customer->nama}}</x-atom.table-td>
                    <x-atom.table-td>{{tanggalan_format($item->tgl_nota)}}</x-atom.table-td>
                    <x-atom.table-td>
                        @if($item->jenis_bayar == 'tunai'||$item->jenis_bayar == 'Tunai'||$item->jenis_bayar == 'cash')
                            Tunai
                        @else
                            Tempo
                        @endif
                    </x-atom.table-td>
                    <x-atom.table-td>{{$item->tgl_tempo ? tanggalan_format($item->tgl_tempo) : ''}}</x-atom.table-td>
                    <x-atom.table-td>{{$item->status_bayar}}</x-atom.table-td>
                    <x-atom.table-td class="text-right">{{rupiah_format($item->total_bayar)}}</x-atom.table-td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
