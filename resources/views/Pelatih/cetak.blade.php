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
    <title>Cetak Daftar Pelatih</title>

</head>

<body> 
    <div class="from-group mt-5">
        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4 " style="margin: auto;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="80px">
            <span class="h4" style="color: #003459;"><strong><i>ONE </i>SOCCER</strong></span>
        </div>
        <h3 class="" style="text-align: center;"><b>Laporan Data Pelatih</b></h3>
            <table class="table table-bordered table-hovered DataTable mt-3" style=" margin: auto;
            width:80vw;
            background:#003459;
            padding:( 1.5); border:3px solid #003459; ">
                <thead style="border:3px solid #003459; ">
                    <tr>
                        <th>NIK</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th>Email</th>
                        <th>Tempat, Tanggal Lahir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelatih as $pl)
                        <tr idPL="{{ $pl->id }}">
                            <td class="col-1">{{ $pl->nik_pelatih }}</td>
                            <td class="col-1" style="text-align: center"> 
                                @if ($pl->user->foto_profil)
                                    <img src="{{asset('storage/' . $pl->user->foto_profil) }}" alt="Foto Profil" style="width: 90px; height: 90px;" class="rounded-circle">
                                @else
                                    <i class="bi bi-person-circle"  style="font-size: 40px;"></i> 
                                @endif
                            </td>
                            <td class="col-2">{{ $pl->nama_pelatih }}</td>
                            <td class="col-1">{{ $pl->alamat }}</td>
                            <td class="col-1">{{ $pl->no_telp }}</td>
                            <td class="col-1">{{ $pl->email }}</td>
                            <td class="col-5">
                                {{ $pl->tempat_lahir }}
                                {{\Carbon\Carbon::parse($pl->tanggal_lahir)->format('j F Y') }}
                            </td>
                    @endforeach
                </tbody>
            </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>

</body>