@extends('layouts.layout')
@section('title', 'Berita')
@section('content')   

<div class="mt-4">
    <div class="row mt-4">
        <div>
            <div class="card align-items-center" style="border: 2px solid #00171F;">
                <div class="card-body">
                    <span class="h3 text-uppercase "> <strong>Berita Sekolah</strong></span>
                </div>
            </div>

            
        </div>
    
        @if ($berita->count() > 0)
        @foreach($berita as $br)
            <div class="col-lg-4 col-md-12 mb-1 mb-lg-0 berita-container">
                <div idBR={{$br->id_berita}} >
                    <div class="col-md-3 card mt-4 align-items-center" style="width: 290px;">    
                    <a class="dropdown-item z-0 d-flex justify-content-center" href="{{ url('berita', ['detail', $br->id_berita]) }}"> 
                        <img src="{{ asset('storage/' . $br->foto_berita) }}" alt="{{'storage/foto_berita/' . $br->foto_berita}}" 
                            height="220" width="260" class="rounded p-2 pt-4" >
                    </a>

                        <div class="col d-flex justify-content-between mb-3 mt-3 ps-4">
                            <div>
                                <span style="font-weight: 300; font-size: 18px;" > 
                                {{$br->judul_berita}} 
                                </span>
                            </div>   
                             @if (Auth::check() && Auth::user()->role == 'admin')
                             <div class="ps-3" style="display: flex; align-items: center;">
                                <div class="dropdown dropend" style="margin-right: 20px;">
                                    <i class="bi bi-three-dots-vertical" 
                                        style="font-size: 20px; cursor: pointer;"
                                        id="beritaDropdown" data-bs-toggle='dropdown' data-bs-offset="-10,20">
                                    </i>
                                    <div class="dropdown-menu z-2" style="width: 200px;" aria-labelledby="beritaDropdown">
                                        <h6 class="dropdown-header">Apa Yang Akan Anda Lakukan?</h6>

                                        <a class="dropdown-item editBtn" data-bs-toggle="modal" data-bs-target="#edit-modal-{{$br->id_berita}}" 
                                            style="cursor: pointer" idBR="{{$br->id_berita}}"> 
                                            <i class="bi bi-pencil" style="font-size: 20px;"></i> 
                                            <strong class="ms-1">Edit Data Berita</strong> 
                                        </a>

                                        <a class="dropdown-item hapusBtn" idBR="{{$br->id_berita}}" style="cursor: pointer"> 
                                            <i class="bi bi-trash" style="font-size: 20px;"></i> 
                                            <strong class="ms-1">Hapus Data Berita</strong> 
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
        {{-- EDIT BERITA--}}
        <div class="modal fade" id="edit-modal-{{$br->id_berita}}" tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 70%">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Berita</h1>
                </div>
                <div class="modal-body">
                    <form id="edit-br-form-{{$br->id_berita}}" method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <label>Judul Berita Baru</label>
                            <textarea name="judul_berita" id="" rows="2" 
                                required class="form-control" style="resize: none">{{$br->judul_berita}}
                            </textarea>
                        </div>
                        <input type="hidden" name="id_berita" value="{{$br->id_berita}}">

                        <div class="form-group">
                            <label>Detail Berita Baru</label>
                            <textarea name="isi_berita" id="" rows="10" 
                                required class="form-control" style="resize: none">{{$br->isi_berita}}
                            </textarea>
                        </div>
                        <input type="hidden" name="id_berita" value="{{$br->id_berita}}">

                        <div class="row">
                            <div class="col-md-4 mt-3 align-items-center">
                                <label for="fileUpload">Upload Gambar (frame 1:1)</label>
                                <input type="file" name="foto_berita" id="fileUpload" onchange="previewImage()"
                                    class="btn w-auto btn-outline-primary form-control">
                                <img src="#" id="imagePreview" alt="preview" 
                                    style="width: 345px; height: 200px; display: none; object-fit: cover;" 
                                    class="mt-2 rounded ">
                                    
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

                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary edit-btn" form="edit-br-form-{{$br->id_berita}}">
                        Edit
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
        @endforeach      

        @else
        <span class="text-center text-capitalize " style="font-size: 60px; font-weight: 700; color: #7c7c7c;" > 
            Tidak ada berita
        </span>
        @endif
    </div>
</div>
<div class="col d-flex justify-content-end mb-2 mt-3">
    @if (Auth::check() && Auth::user()->role == 'admin')
    <a href="{{ url('berita', ['tambah']) }}" class="position-fixed z-10 bottom-0 end-0">
        <i class="bi bi-plus-circle-fill bi-3x" style="font-size: 35px; margin: 30px; color:#003459;"></i>
    </a>@endif
</div>


@endsection
@section('footer')
    <script type="module">
         //delete pop up
         $('.berita-container').on('click', '.hapusBtn', function(e) {
            e.preventDefault();
            let idBR = $(this).attr('idBR');
            swal.fire({
                title: "Yakin ingin menghapus berita?",
                text: 'Berita yang sudah dihapus, tidak bisa dikembalikan.',
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/berita/hapus/' + idBR) 
                    .then(function(response) {
                        console.log(response);
                        if (response.data.success) {
                            swal.fire('Selamat!', 'Berita berhasil dihapus.', 'success').then(function() {
                                // Refresh Halaman
                                location.reload();
                            });
                        } else {
                            swal.fire('Waduh!', 'Berita gagal dihapus.', 'warning').then(function() {
                                // Refresh Halaman
                                location.reload();
                            });
                        }
                    }).catch(function(error) {
                        swal.fire('Waduh!', 'Berita gagal dihapus.', 'error').then(function() {
                            // Refresh Halaman
                        });
                    });
                }
            });
        });

         // edit pop up
         $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idBR = $(this).attr('idBR');
            $(`#edit-br-form-${idBR}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['id_berita'] = idBR;
                axios.post(`/berita/edit/${idBR}`, data, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                })
                    .then(() => {
                        $(`#edit-modal-${idBR}`).css('display', 'none')
                        swal.fire('Selamat!', 'Berita berhasil diedit.', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Maaf!', 'Data gagal diedit.', 'warning');
                    })
            })
        })

    </script>
@endsection