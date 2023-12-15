@extends('layouts.layout')
@section('title', 'Tambah Berita')
@section('content')

<div class="container mt-4 mb-4">
    <div class="row">

        <div class="card align-items-center ms-2" style="width: 98%;">
            <div class="card-body">
                <span class="h3 text-uppercase">
                    <strong>Tambah Berita Sekolah</strong>
                </span>
            </div>
        </div>

        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('berita', ['tambah']) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <input type="hidden" name="nik_admin" value="{{Auth::user()->admin["nik_admin"]}}">

                        <div class="form-group mt-2">
                            <label for="">Judul:</label>
                            <textarea name="judul_berita" id="" rows="2"
                                class="form-control"
                               placeholder="Judul Berita" style="resize: none" ></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="">Isi Berita:</label>
                            <textarea name="isi_berita" id="" rows="10"
                                class="form-control"
                               placeholder="Keterangan Berita" style="" ></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3 align-items-center">
                                <label for="fileUpload">Upload Gambar (frame 1:1)</label>
                                <input type="file" name="foto_berita" id="fileUpload" onchange="previewImage()"
                                    class="btn w-auto btn-outline-primary form-control">
                                <img src="#" id="imagePreview" alt="preview" 
                                    style="width: 345px; height: 200px; display: none; object-fit: cover;" 
                                    class="mt-2 rounded ">
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

                <hr>


                <div class="row">
                    <div class="col-md-4">
                        <button class="btn btn-primary addBtn" type="submit">Simpan</button>
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
        axios.post(`/berita/tambah`, data, {
            headers: { 'Content-Type': 'multipart/form-data' }
        })
        .then((res) => {
            swal.fire('Selamat!', 'Berita berhasil ditambahkan.', 'success').then(function () {
                window.location.href = '/berita'; 
            })
        })
        .catch((err) => {
            swal.fire('Berita gagal ditambahkan!', 'Pastikan mengisi data seluruhnya.', 'warning');
        });
    });
    </script>
@endsection