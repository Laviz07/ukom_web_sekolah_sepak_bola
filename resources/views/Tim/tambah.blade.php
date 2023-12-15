@extends('layouts.layout')
@section('title', 'Tambah Tim')

@section('content')
<div class="container mt-4 mb-4">
    <div class="row">

        <div class="card align-items-center ms-2" style="width: 98%;">
            <div class="card-body">
                <span class="h3 text-uppercase "> <strong>Tambah Tim</strong></span>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card ">
             
                <div class="card-body" >
                    <form action="{{ url('tim', ['tambah'])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                            <label >Nama Tim:</label>
                                            <input type="text" class="form-control" required name="nama_tim">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                            <label for="pilihPelatih">Nama Pelatih:</label>
                                            {{-- <input type="text" class="form-control" required name="nama_pelatih"> --}}
                                            <select name="nik_pelatih" id="pilihPelatih" class="form-select mb-3">
                                                <option value="" selected disabled>Pilih Pelatih Tim</option>
                                                @foreach ($pelatih as $pl)
                                                    <option value="{{$pl->nik_pelatih}}">{{$pl->nama_pelatih}}</option>
                                                @endforeach
                                                
                                            </select>
                                    </div>
                                </div>
                            </div>
                               
                                <div class="form-group">
                                    <label >Deskripsi Tim:</label>
                                    <textarea required name="deskripsi_tim" id="" class="form-control" rows="3" placeholder="Deskripsi Tim" style="resize: none"></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-3 align-items-center">
                                        <label for="fileUpload" class="">Upload Foto (masukkan frame 2:4) :</label>
                                        <input type="file" name="foto_tim" id="fileUpload" onchange="previewImage()"
                                            class="btn w-auto btn-outline-primary form-control">
                                        <img src="#" id="imagePreview" alt="preview" 
                                            style="width: 345px; height: 200px; display: none; object-fit: cover;" 
                                            class="mt-2 rounded ">
                                    </div>
                                </div>

                                <script>
                                    function previewImage(){
                                        var input = document.getElementById("fileUpload");
                                        var preview = document.getElementById("imagePreview")

                                        if(input.files && input.files[0]){
                                            var reader = new FileReader();

                                            reader.onload = function(e){
                                                preview.src = e.target.result;
                                                preview.style.display = 'block';
                                            }

                                            reader.readAsDataURL(input.files[0]);
                                        } else {
                                            preview.src = "#";
                                            preview.style.display = "none";
                                        }
                                    }
                                </script>
                            </div>
                        </div>  
                        {{-- <p> --}}
                            <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <button class="btn btn-primary addBtn" type="button">Simpan</button>
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
        axios.post(`/tim/tambah`, data, {
            headers: { 'Content-Type': 'multipart/form-data' }
        })
        .then((res) => {
            swal.fire('Selamat!', 'Tim berhasil ditambahkan.', 'success').then(function () {
                window.location.href = '/tim'; 
            })
        })
        .catch((err) => {
            swal.fire('Tim gagal ditambahkan!', 'Pastikan mengisi data seluruhnya.', 'warning');
        });
    });
    </script>
@endsection