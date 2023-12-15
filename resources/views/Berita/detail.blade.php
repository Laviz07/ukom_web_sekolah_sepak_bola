@extends('layouts.layout')
@section('title', 'Detail Berita')
@section('content')
<div class="container mt-4 mb-4 text-center">
    <div class="row">
        <span style="font-size: 45px; font-weight: 600;" class="text-capitalize "> {{$berita->judul_berita}} </span>
        <div class="mt-1" style="font-size: 16px; font-weight: 400;">
            <span style="color: #7C7C7C;">Dibuat Oleh</span>
            <span style="color: #003459;" class="text-capitalize">{{$berita->admin->nama_admin}}</span>
            <hr style="width: 20px; height: 2px; font-weight: 900; color: black; 
                border: none;  background-color: black; display: inline-block; vertical-align: middle; ">
              <span style="color: #003459;" class="text-capitalize">
                {{\Carbon\Carbon::parse($berita->created_at)->format('d F Y') }}
            </span>
        </div>
    </div>
    <div class="row mt-1 d-flex justify-content-between">
        <div>
            <div class="row p-4 d-flex flex-column align-items-center justify-content-center">
                
                <div class="text-center">
                    
                    <img src="{{ asset('storage/' . $berita->foto_berita) }}" alt="{{$berita->nama_detail_berita}}" style="width: 570px; border-radius: 30px">
                </div>
            </div>
        </div>
        

        <div class="container mt-4 mb-4 text-center" style="width: 90%">
            <div class="row p-3">
                <div class="row mt-3">
                    <p style="font-size: 16px; text-align: left"> 
                        {!! nl2br(e($berita->isi_berita)) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col d-flex justify-content-center mt-3">
        <a href="{{ url('/berita', []) }}">
            <btn class="btn btn-primary">Kembali</btn>
        </a>
    </div>
</div>
@endsection