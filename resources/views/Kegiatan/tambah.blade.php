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
                    <form action="{{ url('jadwal', [ $jadwal->id_jadwal, 'kegiatan','tambah'])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="">
                                <div class="form-group mt-2">
                                    <label >Nama Kegiatan:</label>
                                    <input type="text" class="form-control" required name="nama_kegiatan">
                                    <input type="hidden" name="role" value="kegiatan">
                                </div>

                                <input type="hidden" name="id_jadwal" value="{{$jadwal->id_jadwal }}">

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
                                                <option value="" selected disabled>Pilih Tipe Kegiatan</option>
                                                <option value="pertandingan">pertandingan</option>
                                                <option value="latihan">latihan</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group mt-2">
                                             <label >Nama Pelatih:</label>
                                           {{-- <input type="text" class="form-control" required name="nama_pelatih"> --}}

                                        <select name="nik_pelatih" required id="pilihPelatih" class="form-select mb-3">
                                            <option value="" selected disabled>Pilih Pelatih</option>
                                            @foreach ($pelatih as $pl)
                                                <option value="{{ $pl->nik_pelatih }}">{{ $pl->nama_pelatih }}</option>
                                            @endforeach
                                        </select> 
                                    </div> 
                                    </div>

                                </div>
                               
                                <div class="form-group">
                                    <label >Detail Kegiatan:</label>
                                    <textarea required name="detail_kegiatan"class="form-control" rows="3" placeholder="Detail Kegiatan" style="resize: none"></textarea>
                                </div>

                                {{-- <div class="form-group">
                                    <label >Laporan Kegiatan:</label>
                                    <textarea required name="laporan_kegiatan" class="form-control" rows="3" placeholder="Laporan Kegiatan" style="resize: none"></textarea>
                                </div> --}}

                                  <div class="row">
                                    <div class="col-md-4 mt-3 align-items-center">
                                        <label for="fileUpload" class="">Upload Foto</label>
                                        <input type="file" name="foto_kegiatan" id="fileUpload" 
                                            class="btn w-auto btn-outline-primary form-control" onchange="previewImage()">
                                        <img src="#" id="imagePreview" alt="preview" 
                                            style=" height: 300px; display: none; object-fit: cover;" 
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
                        </div>  
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
<script type="module">
    // add pop up
    $('.addBtn').on('click', function (e) {
        e.preventDefault();
        let data = new FormData(e.target.form);
        axios.post(`/jadwal/${data.get('id_jadwal')}/kegiatan/tambah`, data, {
            headers: { 'Content-Type': 'multipart/form-data' }
        })
        .then((res) => {
            swal.fire('Selamat!', 'Kegiatan berhasil ditambahkan.', 'success').then(function () {
                window.location.href = `/jadwal/kegiatan/${data.get('id_jadwal')}`;
            })
        })
        .catch((err) => {
            swal.fire('Kegiatan gagal ditambahkan!', 'Pastikan mengisi data seluruhnya.', 'warning');
        });
    });
</script>
@endsection