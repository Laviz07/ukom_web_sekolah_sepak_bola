@extends('layouts.layout')
@section('title', 'Detail Pemain')
@section('content')
<div class="container mt-4 mb-4">
    <div class="row mt-4 d-flex justify-content-between">
        <div class="col-md-3 card">
            <div class="row p-4 d-flex flex-column align-items-center justify-content-center">
                <div class="text-center">
                    <img src="{{ asset('storage/' . $pemain->user->foto_profil) }}" alt="{{$pemain->nama_pemain}}" class="rounded-circle" style="width: 170px; height: 170px;">
                </div>
                <div class="mt-4 text-center">
                    <div>
                        <span class="text-capitalize" style="font-weight: 800; font-size: 26px;">{{$pemain->nama_pemain}}</span>
                    </div>
                    <div class="row">
                        <span>No. Telp: 
                            <a href="https://wa.me/62{{$pemain->no_telp}}" style="text-decoration: none">
                                0{{$pemain->no_telp}}
                            </a>
                        </span>
                        <span>Email: {{$pemain->email}}</span>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="col-md-8 card" style="width: 73%">
            <div class="row p-3">
                <span style="font-size:24px; font-weight: 700">Detail Peserta:</span>

                <div class="row mt-3">
                    <span style="font-size: 16px; font-weight: 600;">Tempat, Tanggal Lahir:</span>
                    <span style="font-size: 16px;"> 
                        {{$pemain->tempat_lahir}}, 
                        {{\Carbon\Carbon::parse($pemain->tanggal_lahir)->format('j F Y') }}
                    </span>
                </div>

                <div class="row mt-3">
                    <span style="font-size: 16px; font-weight: 600;">Alamat:</span>
                    <span style="font-size: 16px;"> {{$pemain->alamat}}</span>
                </div>

                <div class="row mt-3">
                    <span style="font-size: 16px; font-weight: 600;">Deskripsi Diri:</span>
                    <span style="font-size: 16px;"> {{$pemain->deskripsi_pemain}} </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4 align-items-center text-center ms-4" style="text-align: center;">
        <div class="row p-4 col-md-4" style="background-color: #7FDEFF">
            <span class="text-uppercase" style="font-size:40px; font-weight:700;"> 
                {{$pemain->no_punggung}} 
            </span>
            <span style="font-size:16px; font-weight:700;">No Punggung</span>
        </div>

        <div class="row p-4 col-md-4" style="background-color: #DFFFFD">
            <span class="text-uppercase" style="font-size:40px; font-weight:700;">
                @if ($pemain->tim)
                    @if ($pemain->tim->id_tim)
                        {{ $pemain->tim->nama_tim }}
                    @else
                        No Team
                    @endif
                    @else
                    No Team
                @endif
            </span>
            <span class="mt-2" style="font-size:16px; font-weight:700;">Nama Tim</span>
        </div>

        <div class="row p-4 col-md-4" style="background-color: #7FDEFF">
            <span class="text-uppercase" style="font-size:40px; font-weight:700;"> 
                {{$pemain->posisi}} 
            </span>
            <span  class="mt-2" style="font-size:16px; font-weight:700;">Posisi</span>
        </div>
    </div>
</div>
@endsection