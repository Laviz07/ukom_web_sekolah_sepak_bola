@extends('layouts.layout')
@section('title', 'Galeri Sekolah')
@section('content')   

    <div class="mt-4">

        <div>
            <div class="card align-items-center" style="border: 2px solid #00171F;">
                <div class="card-body">
                    <span class="h3 text-uppercase "> <strong>Galeri Sekolah</strong></span>
                </div>
            </div>

            <div class="row mt-4 mb-4">
                @if ($galeri->count() > 0)
                    
                {{-- <pre>{{ print_r($galeri) }}</pre> --}}
                @foreach($galeri as $gl)
                {{-- <p>{{$gl->id_galeri}}</p> --}}

                <div class="col-lg-4 col-md-12 mb-4 mt-4 mb-lg-0">

                    <div class="image-container" idGL={{$gl->id_galeri}} >

                        <img class="image" src="{{ asset('storage/' . $gl->foto) }}" alt="{{$gl->keterangan_foto}}" 
                            style="width: 350px; height: 200px; border-radius: 5px">

                        <div class="overlay ">
                            <span class="caption text-white" style="font-size: 20px; text-align: center;"> 
                                {{$gl->keterangan_foto}} 
                                {{$gl->id_galeri}} 
                            </span>
                        </div>

                        @if (Auth::check() && Auth::user()->role == 'admin')
                            <div class="overlay" 
                                style="position: absolute; top: 0; left: 0; padding-left: 40px; padding-top: 50px" >
                                <div class="dropdown dropend" style="display: inline-block; vertical-align: middle;">
                                
                                        <i  class="bi bi-three-dots-vertical text-white" 
                                            style="font-size: 26; vertical-align: middle; cursor: pointer;"
                                            id="galeriDropdown" data-bs-toggle='dropdown' data-bs-offset="-10,20">
                                        </i>

                                    <div class="dropdown-menu" style="width: 200px;" aria-labelledby="galeriDropdown">
                                    
                                    <h6 class="dropdown-header">Apa Yang Akan Anda Lakukan?</h6>

                                    @if (Auth::user()['role']=='admin')
                                        <a class="dropdown-item editBtn" data-bs-toggle="modal" data-bs-target="#edit-modal-{{$gl->id_galeri}}" 
                                            style="cursor: pointer" idGL = {{$gl->id_galeri}} > 
                                            <i class="bi bi-pencil"  style="font-size: 20px; vertical-align: middle; "></i> 
                                            <strong class="ms-1" >Edit Data Foto</strong> 
                                        </a>

                                        
                                        <a class="dropdown-item hapusBtn" idGL={{$gl->id_galeri}} style="cursor: pointer"> 
                                            <i class="bi bi-trash"  style="font-size: 20px; vertical-align: middle; "></i> 
                                            <strong class="ms-1">Hapus Data Foto</strong> 
                                        </a>
                                    @endif

                                    </div>

                                </div>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- EDIT GAMBAR--}}
                <div class="modal fade" id="edit-modal-{{$gl->id_galeri}}" tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Gambar</h1>
                        </div>
                        <div class="modal-body">
                            <form id="edit-gl-form-{{$gl->id_galeri}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <div class="form-group">
                                    <label>Keterangan Gambar</label>
                                    <textarea name="keterangan_foto" id="" rows="2" 
                                        required class="form-control" style="resize: none">{{$gl->keterangan_foto}}
                                    </textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mt-3 align-items-center">
                                        <label for="fileUpload">Upload Gambar (frame 1:1)
                                        </label>
                                        <input type="file" name="foto" id="fileUpload" onchange="previewImage()"
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
                            <button type="submit" class="btn btn-primary edit-btn" form="edit-gl-form-{{$gl->id_galeri}}">
                                Edit
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>
                @endforeach      
                
                @else
                    <span class="text-center text-capitalize " style="font-size: 60px; font-weight: 700; color: #7c7c7c;" > 
                        Tidak ada foto 
                    </span>
                @endif
            </div>
        
        </div>
    </div>
    <div class="col d-flex justify-content-end mb-2 mt-3">
        @if (Auth::check() && Auth::user()->role == 'admin')
        <a href="{{ url('galeri', ['tambah']) }}" class="position-fixed z-10 bottom-0 end-0">
            <i class="bi bi-plus-circle-fill bi-3x" style="font-size: 35px; margin: 30px; color:#003459;"></i>
        </a>@endif
    </div>
@endsection
@section('footer')
    <script type="module">
         //delete pop up
         $('.image-container').on('click', '.hapusBtn', function(e) {
            e.preventDefault();
            let idGL = $(this).attr('idGL');
            swal.fire({
                title: "Yakin ingin menghapus galeri?",
                text: 'Galeri yang sudah dihapus, tidak bisa dikembalikan.',
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/galeri/hapus/' + idGL) 
                    .then(function(response) {
                        console.log(response);
                        if (response.data.success) {
                            swal.fire('Selamat!', 'Galeri berhasil dihapus.', 'success').then(function() {
                                // Refresh Halaman
                                location.reload();
                            });
                        } else {
                            swal.fire('Waduh!', 'Galeri gagal dihapus.', 'warning').then(function() {
                                // Refresh Halaman
                                location.reload();
                            });
                        }
                    }).catch(function(error) {
                        swal.fire('Waduh!', 'Galeri gagal dihapus.', 'error').then(function() {
                            // Refresh Halaman
                        });
                    });
                }
            });
        });

         // edit pop up
         $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idGL = $(this).attr('idGL');
            $(`#edit-gl-form-${idGL}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['id_galeri'] = idGL;
                axios.post(`/galeri/edit/${idGL}`, data, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                })
                    .then(() => {
                        $(`#edit-modal-${idGL}`).css('display', 'none')
                        swal.fire('Selamat!', 'Galeri berhasil diedit.', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Waduh!', 'Galeri gagal diedit.', 'warning');
                    })
            })
        })

    </script>
@endsection