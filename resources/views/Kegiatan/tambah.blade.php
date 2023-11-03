@extends('layouts.layout')
@section('title', 'Tambah Kegiatan')

@section('content')
<div class="container mt-4 mb-4">
    <div class="row">

        <div class="card align-items-center ms-2" style="width: 98%;">
            <div class="card-body">
                <span class="h3 text-uppercase "> <strong>Tambah Kegiatan</strong></span>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card ">
             
                <div class="card-body" >
                    <form action="{{ url('kegiatan', ['tambah'])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="">
                                <div class="form-group mt-2">
                                    <label >Nama Kegiatan:</label>
                                    <input type="text" class="form-control" required name="nama_kegiatan">
                                    <input type="hidden" name="role" value="kegiatan">
                                </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                            <label >Jam Mulai:</label>
                                            <input type="time" class="form-control" required name="jam_mulai">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                            <label >Jam Selesai:</label>
                                            <input type="time" class="form-control" required name="jam_selesai">
                                    </div>
                                </div>
                            </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label >Tipe Kegiatan:</label>
                                            <select required name="tipe_kegiatan" class="form-select mb-3">
                                                <option selected value="pertandingan">pertandingan</option>
                                                <option selected value="latihan">latihan</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                            <label >Nama Pelatih:</label>
                                            <input type="text" class="form-control" required name="nama_pelatih">
                                        </div> 
                                    </div>

                                </div>
                               
                                <div class="form-group">
                                    <label >Detail Kegiatan:</label>
                                    <textarea required name="detail_kegiatan" id="" class="form-control" rows="3" placeholder="Detail Kegiatan" style="resize: none"></textarea>
                                </div>

                                <div class="form-group">
                                    <label >Laporan Kegiatan:</label>
                                    <textarea required name="laporan_kegiatan" id="" class="form-control" rows="3" placeholder="Laporan Kegiatan" style="resize: none"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-3 align-items-center">
                                        <label for="fileUpload" class="">Upload Foto (masukkan frame 1:1) :</label>
                                        <input type="file" name="foto_kegiatan" id="fileUpload" class="btn w-auto btn-outline-primary form-control">
                                    </div>
                                </div>
                            </div>
                        </div>  
                        {{-- <p> --}}
                            <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <button  class="btn btn-primary addBtn" type="button">Simpan</button>
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
        axios.post(`/kegiatan/tambah`, data, {
            headers: { 'Content-Type': 'multipart/form-data' }
        })
        .then((res) => {
            swal.fire('Berhasil tambah data!', '', 'success').then(function () {
                window.location.href = '/kegiatan/{id}'; 
            })
        })
        .catch((err) => {
            swal.fire('Gagal tambah data!', '', 'warning');
        });
    });
    </script>
@endsection