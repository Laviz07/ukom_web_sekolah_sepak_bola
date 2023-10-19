@extends('layouts.layout')
@section('title', 'Tambah Foto Sekolah')
@section('content')

<div class="container mt-4 mb-4">
    <div class="row">

        <div class="card align-items-center ms-2" style="width: 98%;">
            <div class="card-body">
                <span class="h3 text-uppercase">
                    <strong>Tambah Foto Galeri</strong>
                </span>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('galeri', ['tambah']) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="form-group mt-2">
                            <label for="">Keterangan Gambar:</label>
                            <textarea name="keterangan_foto" id="" rows="2"
                                class="form-control"
                               placeholder="Keterangan Foto" style="resize: none" ></textarea>
                        </div>
                    <div class="row">
                        <div class="col-md-4 mt-3 align-items-center">
                            <label for="fileUpload">Upload Gambar</label>
                            <input type="file" name="foto" id="fileUpload" class="btn w-auto btn-outline-primary form-control">
                        </div>
                    </div>

                </div>

                <hr>


                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
                    
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection