@extends('layouts.layout')
@section('title', 'Tambah Jadwal')

@section('content')
<div class="container mt-4 mb-4">
    <div class="row">

        <div class="card align-items-center ms-2" style="width: 98%;">
            <div class="card-body">
                <span class="h3 text-uppercase "> <strong>Tambah Jadwal</strong></span>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card ">
             
                <div class="card-body" >
                    <form action="{{ url('jadwal', ['tambah'])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="">
                                <div class="form-group mt-2">
                                    <label >Judul Kegiatan:</label>
                                    <input type="text" class="form-control" required name="judul_kegiatan">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="tanggal">Tanggal:</label>
                                            <input type="date" id="tanggal" name="tanggal_kegiatan" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                            {{-- <p> --}}
                                <hr>
                        <div class="row">
                            <div class="col-md-1">
                                <a href="{{ url('jadwal') }}">
                                    <btn class="btn btn-primary">Kembali</btn>
                                </a>
                            </div>
                            <div class="col-md-1">
                                <button  class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection