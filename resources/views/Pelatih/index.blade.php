@extends('layouts.layout')
@section('title', 'List Pelatih')
@section('content')   

<div class="container mt-4 mb-4">
    <div>
        <div class="card p-2 align-items-center" style="border: 2px solid #00171F;">
            <div class="card-body">
                <span class="h2 text-uppercase "> <strong>Daftar Pelatih</strong></span>
            </div>
        </div>

        <div class="col d-flex justify-content-between mb-2  mt-3">
            <a href="{{ url('/', []) }}">
                <btn class="btn btn-primary">Kembali</btn>
            </a>

            @if (Auth::user()['role']=='admin')
                <a href="{{ url('pelatih', ['tambah'])}}" class="justify-content-end">
                    <btn class="btn btn-success">Tambah </btn>
                </a>
            @endif
            
        </div>

        <div class=" mt-3">
                <table class="table table-hovered table-bordered DataTable  ">
                    <thead>
                        <tr style="text-align: center; font-size: 17px; font-weight: 600;">
                            <td>No</td>
                            <td>Foto</td>
                            <td>Nama</td>
                            <td>NIK</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                        ?>

                    @foreach ($pelatih as $pl)

                        <tr style="vertical-align: middle; font-size: 17px;">
                            <td class="col-1" style="text-align: center;"> {{$no++}} </td>
                            <td class="col-1" style="text-align: center"> 
                                @if ($pl->user->foto_profil)
                                    <img src="{{asset('storage/' . $pl->user->foto_profil) }}" alt="Foto Profil" style="width: 90px; height: 90px;" class="rounded-circle">
                                @else
                                    <i class="bi bi-person-circle"  style="font-size: 40px;"></i> 
                                @endif
                            </td>
                            <td class="col-5"> {{$pl->nama_pelatih}} </td>
                            <td class="col-3" style="text-align: center"> {{$pl->nik_pelatih}} </td>
                            <td style="text-align: center">
                                {{-- <a href="#" class="text-decoration-none">
                                    <btn class="btn btn-primary">Edit</btn>
                                </a>

                                <a href="#" class="text-decoration-none">
                                    <btn class="btn btn-success">Detail</btn>
                                </a>

                                <btn class="hapusBtn btn btn-danger">Hapus</btn> --}}

                                <div class="dropdown dropend" style="display: inline-block; vertical-align: middle;">
                                    <button class="btn btn-primary" id="navbarDropdownMenuLink" data-bs-toggle='dropdown' data-bs-offset="-10,20">
                                        Action
                                        <i  class="bi bi-three-dots-vertical " 
                                            style="font-size: 26; vertical-align: middle; cursor: pointer;">
                                        </i>
                                    </button>

                                    <div class="dropdown-menu" style="width: 200px;" aria-labelledby="navbarDropdownMenuLink">
                                    
                                    <h6 class="dropdown-header">Apa Yang Akan Anda Lakukan?</h6>
                                       <a class="dropdown-item" href="#"> 
                                        <i class="bi bi-eye"  style="font-size: 20px; vertical-align: middle; "></i> 
                                        <strong class="ms-1">Lihat Detail Pelatih</strong> 
                                       </a>

                                      
                                        <a class="dropdown-item" href="#"> 
                                            <i class="bi bi-pencil"  style="font-size: 20px; vertical-align: middle; "></i> 
                                            <strong class="ms-1" >Edit Data Pelatih</strong> 
                                        </a>

                                        <a class="dropdown-item" href="#"> 
                                            <i class="bi bi-trash"  style="font-size: 20px; vertical-align: middle; "></i> 
                                            <strong class="ms-1">Hapus Data Pelatih</strong> 
                                        </a>
                                       

                                    </div>

                                </div>

                            </td>
                        </tr>

                        {{-- EDIT PELATIH --}}
                        <div class="modal fade" id="edit-modal-{{$pl->nisn_pelatih}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pelatih</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form id="edit-js-form-{{$pl->nisn_pelatih}}">
                                            <div class="form-group">
                                                <label>Nama Pelatih</label>
                                                <input placeholder="example" type="text" class="form-control mb-3"
                                                        name="jenis_surat"
                                                        value="{{$pl->nama_pelatih}}"
                                                        required/>
                                                @csrf
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary edit-btn"
                                                form="edit-js-form-{{$pl->nisn_pelatih}}">
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
        $('.DataTable').DataTable();
    </script>
@endsection

{{-- @section('footer')
<script>
    function clearText() {
        $(`.fileName`).text('');
        $('#fileUpload').val('');
    }
</script>
<script type="module">
    $('.table').DataTable();

    $('input[type=file]').on('change', function () {
        const fileName = $(this).val().replace(/.*(\/|\\)/, '');
        $(`.fileName`).text(fileName);
    })

    // TAMBAH DATA SWEETALERT
    $('#tambah-surat-form').on('submit', function (e) {
            e.preventDefault();
            let data = new FormData(e.target);
            console.log(Object.fromEntries(data))
            axios.post('/dashboard/surat', data, {
                'Content-Type': 'multipart/form-data'
            })
                .then((res) => {
                    $('#tambah-surat-modal').css('display', 'none')
                    swal.fire('Berhasil tambah data!', '', 'success').then(function () {
                        location.reload();
                    })
                })
                .catch((err) => {
                    swal.fire('Gagal tambah data!', '', 'warning');
                    console.log(err)
                });
        })
</script>
@endsection --}}