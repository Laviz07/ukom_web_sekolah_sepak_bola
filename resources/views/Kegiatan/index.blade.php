@extends('layouts.layout')
@section('title', 'List Kegiatan')
@section('content')   

<div class="container mt-4 mb-4">

    {{-- LIST JADWAL --}}
    <div>
        <div class="card align-items-center" style="border: 2px solid #00171F;">
            <div class="card-body">
                <span class="h3 text-uppercase "> 
                    <strong>
                        Daftar Kegiatan 
                        {{ $jadwal->judul_kegiatan  }}
                    </strong>
                </span>
            </div>
        </div>

        <div class="col d-flex justify-content-between mb-2  mt-3">
            <a href="{{ url('jadwal', []) }}">
                <btn class="btn btn-primary">Kembali</btn>
            </a>

            @if (Auth::user()['role']=='admin' || Auth::user()['role']=='pelatih')
            <a href="{{ url('jadwal', [$jadwal->id_jadwal, 'kegiatan',  'tambah' ])}}" class="justify-content-end">
                <btn class="btn btn-success">Tambah </btn>
            </a>
            @endif
        </div>

        <div class=" mt-3">
                <table class="table table-hovered table-bordered DataTable  ">
                    <thead>
                        <tr style="text-align: center; font-size: 17px; font-weight: 600;">
                            <td>No</td>
                            <td>Nama Kegiatan</td>
                            <td>Jam</td>
                            <td>Tipe Kegiatan</td>
                            <td>Pelatih</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                        ?>

                @foreach ($jadwal->kegiatan as $kg)
                    
                        <tr style="vertical-align: middle; font-size: 17px;" idKG={{$kg->id_kegiatan}}>
                            <td class="col-0" style="text-align: center;"> {{$no++}} </td>
                            <td class="col-3 text-capitalize text-center "> {{$kg->nama_kegiatan}} </td>
                            <td class="col-3" style="text-align: center"> 
                                {{-- {{$kg->jam_mulai}}  --}}
                                {{\Carbon\Carbon::createFromFormat('H:i:s',$kg->jam_mulai)->format('g:i a')}}
                                -
                                {{-- {{$kg->jam_selesai}}  --}}
                                {{\Carbon\Carbon::createFromFormat('H:i:s',$kg->jam_selesai)->format('g:i a')}}
                            </td>
                            <td class="col-2 text-capitalize text-center "> {{$kg->tipe_kegiatan}} </td>
                            <td class="col-2 text-capitalize text-center "> {{$kg->pelatih->nama_pelatih}} </td>
                            <td class="col-3" style="text-align: center">
                               

                            @if (Auth::user()['role']=='admin' || Auth::user()['role']=='pelatih')
                                <div class="dropdown dropend" style="display: inline-block; vertical-align: middle;">
                                    <button class="btn btn-primary" id="navbarDropdownMenuLink" data-bs-toggle='dropdown' data-bs-offset="-10,20">
                                        Action
                                        <i  class="bi bi-three-dots-vertical " 
                                            style="font-size: 26; vertical-align: middle; cursor: pointer;">
                                        </i>
                                    </button>

                                    <div class="dropdown-menu" style="width: 200px;" aria-labelledby="navbarDropdownMenuLink">
                                    
                                    <h6 class="dropdown-header">Apa Yang Akan Anda Lakukan?</h6> 
                                       <a class="dropdown-item" href="{{ url('jadwal', ['kegiatan', 'detail', $kg->id_kegiatan]) }}"> 
                                        <i class="bi bi-eye"  style="font-size: 20px; vertical-align: middle; "></i> 
                                        <strong class="ms-1">Lihat Detail Kegiatan</strong> 
                                       </a>

                                        <a class="dropdown-item editBtn" data-bs-toggle="modal" data-bs-target="#edit-modal-{{$kg->id_kegiatan}}" 
                                            style="cursor: pointer" idKG={{$kg->id_kegiatan}} > 
                                            <i class="bi bi-pencil"  style="font-size: 20px; vertical-align: middle; "></i> 
                                            <strong class="ms-1" >Edit Data Kegiatan</strong> 
                                        </a>

                                        <a class="dropdown-item hapusBtn" idKG={{$kg->id_kegiatan}} style="cursor: pointer"> 
                                            <i class="bi bi-trash"  style="font-size: 20px; vertical-align: middle; "></i> 
                                            <strong class="ms-1">Hapus Data Kegiatan</strong> 
                                        </a>

                                    </div>

                                </div>
                            @endif

                        @if (Auth::user()['role']=='pemain')
                            <a href="{{ url('kegiatan', ['detail', $kg->id_kegiatan]) }}" class="btn btn-primary" >
                                Lihat Detail
                                <i class="bi bi-search ms-2"  style="font-size: 15px; vertical-align: middle; "></i> 
                            </a>
                        @endif

                            </td>
                        </tr>

                         {{-- EDIT KEGIATAN --}}
                        <div class="modal fade" id="edit-modal-{{$kg->id_kegiatan}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Kegiatan</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form id="edit-kg-form-{{$kg->id_kegiatan}}"  method="POST">
                                            <div class="form-group">
                                                <label>Nama Kegiatan:</label>
                                                <input placeholder="example" type="text" class="form-control mb-3"
                                                        name="nama_kegiatan"
                                                        value="{{$kg->nama_kegiatan}}"
                                                        required/>
                                                @csrf
                                            </div>

                                            <input type="hidden" name="id_jadwal" value="{{$jadwal->id_jadwal}}">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                            <label >Jam Mulai:</label>
                                                            <input type="time" class="form-control" 
                                                                required name="jam_mulai"
                                                                value="{{$kg->jam_mulai}}"
                                                            >
                                                    </div>
                                                </div>
                
                                                <div class="col-md-6">
                                                    <div class="form-group ">
                                                            <label >Jam Selesai:</label>
                                                            <input type="time" class="form-control" 
                                                            required name="jam_selesai"
                                                            value="{{$kg->jam_selesai}}"
                                                            >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label>Nama Pelatih:</label>
                                                <select name="nik_pelatih" id="pilihPelatih" class="form-select mb-3">
                                                    <option value="" disabled selected>Pilih Pelatih</option>
                                                    @foreach ($pelatih as $pl)
                                                        <option value="{{$pl->nik_pelatih}}" {{ $kg->nik_pelatih === $pl->nik_pelatih ? 'selected' : '' }}>
                                                            {{$pl->nama_pelatih}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group mt-3">
                                                <label>Tipe Kegiatan:</label>
                                                <select name="tipe_kegiatan" id="pilihPelatih" class="form-select mb-3">
                                                    <option value="" disabled selected>Pilih Tipe Kegiatan</option>
                                                    <option value="latihan" {{ $kg->tipe_kegiatan === "latihan" ? 'selected' : '' }}>
                                                        Latihan
                                                    </option>
                                                    <option value="pertandingan" {{ $kg->tipe_kegiatan === "pertandingan" ? 'selected' : '' }}>
                                                        Pertandingan
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Detail Kegiatan:</label>
                                                <textarea required name="detail_kegiatan" id="" 
                                                    class="form-control" rows="5" placeholder="Detail Kegiatan" 
                                                    style="resize: none">{{$kg->detail_kegiatan}}
                                                </textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 mt-3 align-items-center">
                                                    <label for="fileUpload">Upload Gambar</label>
                                                    <input type="file" name="foto_kegiatan" id="fileUpload" onchange="previewImage()"
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

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary edit-btn"
                                                form="edit-kg-form-{{$kg->id_kegiatan}}" >
                                            Edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach

                    </tbody>
                </table>
        </div>
           
    </div>

   
</div>

@endsection

@section('footer')
    <script type="module">

        // // edit pop up
        $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idKG = $(this).attr('idKG');
            $(`#edit-kg-form-${idKG}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['id_kegiatan'] = idKG;
                axios.post(`/jadwal/kegiatan/edit/${idKG}`, data, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                })
                    .then(() => {
                        $(`#edit-modal-${idKG}`).css('display', 'none')
                        swal.fire('Selamat!', 'Kegiatan berhasil diedit.', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Waduh!', 'Gagal mengedit kegiatan.', 'warning');
                    })
            })
        })
        
        //delete pop up
        $('.DataTable tbody').on('click','.hapusBtn',function(a){
        a.preventDefault();
        let idKG = $(this).closest('.hapusBtn').attr('idKG');
        swal.fire({
                title : "Apakah anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
    
            }).then((result)=>{
                if(result.isConfirmed){
                    //dilakukan proses hapus
                    axios.delete('/jadwal/kegiatan/hapus/' + idKG).then(function(response){
                        console.log(response);
                        if(response.data.success){
                            swal.fire('Berhasil di hapus!', '', 'success').then(function(){
                                    //Refresh Halaman
                                    location.reload();
                                });
                        }else{
                            swal.fire('Gagal di hapus!', '', 'warning').then(function(){
                                    //Refresh Halaman
                                    location.reload();
                                });
                        }
                    }).catch(function(error){
                        swal.fire('Data gagal di hapus!', '', 'error').then(function(){
                                    //Refresh Halaman
                                   
                                });
                    });
                }
            });
    });

        $('.DataTable').DataTable();
    </script>
@endsection