<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link rel="icon" href="{{ asset('/images/logo.png') }}">

    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <title>@yield('title')</title>

</head>
    <style>
        table, td, th {  
        border: 1px solid #000000;
        text-align: left;
        }

        table {
        border-collapse: collapse;
        width: 100%;
        }

        th {
        padding: 15px;
        text-align: center;
        font-weight: 900;
        }

        td {
            padding: 5px;
        }
                        
    </style>

</head>
<body>
    <div class="from-group mt-5">
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4 " style="margin: auto;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="80px">
            <span class="h4" style="color: #003459;"><strong><i>ONE </i>SOCCER</strong></span>
        </div>
        <h3 class="" style="text-align: center;"><b>Laporan Data Pelatih</b></h3>
            <table class="table table-bordered table-hovered DataTable mt-3" style="width: 72vw; margin-left: 14%;">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Judul Kegiatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    ?>
                    @foreach ($jadwal as $jw)
                        <tr idJW="{{ $jw->jw }}">
                            <td class="col-1">{{ $no++ }}</td>
                            <td class="col-1"> {{\Carbon\Carbon::parse($jw->tanggal_kegiatan)->format('j F Y') }}</td>
                            <td class="col-1">{{ $jw->judul_kegiatan }}</td>
                            {{-- <td class="col-1">
                                <div class="w-100 d-flex flex-column">
                                    <img src="{{ asset('/storage/'. $jw->dokumentasi_pengeluaran)}}" width="100vw"
                                    alt="">
                                </div>
                            </td> --}}
                    @endforeach
                </tbody>
            </table>
    </div>

        <script type="text/javascript">
            window.print();
        </script>
    </body>