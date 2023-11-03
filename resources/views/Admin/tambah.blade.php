@extends('layouts.layout')
@section('title', 'Tambah Admin')

@section('content')
<div class="container mt-4 mb-4">
    <div class="row">

        <div class="card align-items-center ms-2" style="width: 98%;">
            <div class="card-body">
                <span class="h3 text-uppercase "> <strong>Tambah Admin</strong></span>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card ">
             
                <div class="card-body" >
                    <form action="{{ url('admin', ['tambah'])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="">
                                <div class="form-group mt-2">
                                    <label >NIK Admin:</label>
                                    <input type="number" class="form-control" required name="nik_admin">
                                    <input type="hidden" name="role" value="admin">
                                </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                            <label >Username:</label>
                                            <input type="text" class="form-control" required name="username">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                            <label >Nama Lengkap:</label>
                                            <input type="text" class="form-control" required name="nama_admin">
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mt-2">
                                            <label >No. Telepon:</label>
                                            <input type="number" class="form-control" required name="no_telp">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mt-2">
                                            <label >Email:</label>
                                            <input type="email" class="form-control" required name="email">
                                        </div> 
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mt-2">
                                            <label >Password:</label>
                                            <input type="text" class="form-control" required name="password">
                                        </div> 
                                    </div>

                                </div>

                                
                                <div class="row">
                                    <div class="col-md-4 mt-3 align-items-center">
                                        <label for="fileUpload" class="">Upload Foto (masukkan frame 1:1) :</label>
                                        <input type="file" name="foto_profil" id="fileUpload" class="btn w-auto btn-outline-primary form-control">
                                    </div>
                                </div>
                            </div>
                        </div>  
                        {{-- <p> --}}
                            <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <button  class="btn btn-primary addBtn" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
    <script type="module" > 
        // add pop up
        $('.addBtn').on('click', function (e) {
        e.preventDefault();
        let data = new FormData(e.target.form);
        axios.post(`/admin/tambah`, data, {
            headers: { 'Content-Type': 'multipart/form-data' }
        })
        .then((res) => {
            swal.fire('Berhasil tambah data!', '', 'success').then(function () {
                window.location.href = '/admin'; 
            })
        })
        .catch((err) => {
            swal.fire('Gagal tambah data!', '', 'warning');
        });
    });
    </script>
@endsection