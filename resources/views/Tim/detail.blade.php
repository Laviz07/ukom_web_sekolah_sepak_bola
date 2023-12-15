@extends('layouts.layout')
@section('title', 'Detail Tim')
@section('content')
<div class="container mt-4 mb-4">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-body d-flex">
                    <div class="p-2">
                        <img src="{{ asset('storage/' . $tim['foto_tim']) }}" alt="{{$tim->nama_tim}}" 
                        class="rounded card-img-top" style="width: 550px; height: 300px;">
                    </div>
                    <div class="ms-4">
                        <div class="row">
                            <span class="text-capitalize" style="font-weight: 800; font-size: 26px;">
                                {{$tim->nama_tim}}
                            </span>

                            <span class="mt-3" style="font-size: 18px;">{{$tim->deskripsi_tim}}</span>

                            <span class="mt-5" style="font-size: 18px; font-weight: 600">Pelatih:</span>
                            <span class="mt-1 text-capitalize " style="font-size: 18px;">{{$tim->pelatih->nama_pelatih}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

       {{-- LIST ANGGOTA TIM --}}
       <div>
        <div class="card align-items-center" style="border: 2px solid #00171F;">
            <div class="card-body">
                <span class="h3 text-uppercase "> <strong>Daftar Anggota Tim</strong></span>
            </div>
        </div>
        <div class="col d-flex justify-content-end mb-2 mt-3">
            @if (Auth::check() && Auth::user()->role == 'admin')
            <a data-bs-toggle="modal" data-bs-target="#add-modal" class="position-fixed z-10 bottom-0 end-0">
                <i class="bi bi-plus-circle-fill bi-3x" style="font-size: 45px; margin: 30px; color:#003459;"></i>
            </a>@endif
        </div>

        <div class=" mt-3">
                <table class="table table-hovered table-bordered DataTable  ">
                    <thead>
                        <tr style="text-align: center; font-size: 17px; font-weight: 600;">
                            <td>No</td>
                            <td>Foto</td>
                            <td>Nama Pemain</td>
                            <td>NISN Pemain</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                        ?>

                        @foreach ($tim->pemain as $pm)
                        @if ($pm->tim)
                            <tr style="vertical-align: middle; font-size: 17px;" idTm={{$pm->nisn_pemain}}>
                                <td class="col-1" style="text-align: center;"> {{$no++}} </td>
                                <td class="col-1" style="text-align: center"> 
                                    @if ($pm->user->foto_profil)
                                        <img src="{{asset('storage/' . $pm->user->foto_profil) }}" 
                                        alt="Foto Profil" style="width: 90px; height: 90px;" class="rounded-circle">
                                    @else
                                        <i class="bi bi-person-circle"  style="font-size: 40px;"></i> 
                                    @endif
                                </td>
                                <td class="col-5 text-capitalize text-center"> {{$pm->nama_pemain}} </td>
                                <td class="col-3" style="text-align: center"> {{$pm->nisn_pemain}} </td>
                                <td style="text-align: center">
                                    <div class="dropdown dropend" style="display: inline-block; vertical-align: middle;">
                                        <button class="btn btn-primary" id="navbarDropdownMenuLink" data-bs-toggle='dropdown' data-bs-offset="-10,20">
                                            Action
                                            <i  class="bi bi-three-dots-vertical " 
                                                style="font-size: 26; vertical-align: middle; cursor: pointer;">
                                            </i>
                                        </button>
                                        <div class="dropdown-menu" style="width: 230px;" aria-labelledby="navbarDropdownMenuLink">
                                            <h6 class="dropdown-header">Apa Yang Akan Anda Lakukan?</h6>
                                            <a class="dropdown-item" href="{{ url('pemain', ['detail', $pm->nisn_pemain]) }}"> 
                                                <i class="bi bi-eye"  style="font-size: 20px; vertical-align: middle; "></i> 
                                                <strong class="ms-1">Lihat Detail Anggota Tim</strong> 
                                            </a>

                                            <a class="dropdown-item hapusBtn" idTM="{{ $pm->nisn_pemain }}" data-nisn-pemain="{{ $pm->nisn_pemain }}" style="cursor: pointer">
                                                <i class="bi bi-trash" style="font-size: 20px; vertical-align: middle;"></i>
                                                <strong class="ms-1">Keluarkan Anggota Tim</strong>
                                            </a>
                                        </div> 
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @endforeach


                    </tbody>
                </table>
        </div>
           
    </div>

     {{-- TAMBAH ANGGOTA TIM --}}
     <div class="modal fade" id="add-modal" tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Anggota Tim</h1>
            </div>
            <div class="modal-body">
                <form id="add-pm-form" enctype="multipart/form-data">
                   

                    <select name="nisn_pemain" id="pilihPemain" class="form-select mb-3">
                        <option value="" selected disabled>Pilih Anggota Tim</option>
                        @foreach ($pemain as $pm)
                            <option value="{{ $pm->nisn_pemain }}">{{ $pm->nama_pemain }}</option>
                        @endforeach
                        
                    </select>

                    <input type="hidden" name="id_tim" value="{{$tim->id_tim}}">

                </form> 
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary addBtn"
                        form="add-pm-form" >
                    Tambah
                </button>
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

        axios.post(`/tim/tambah/anggota/`, data)
            .then((res) => {
                swal.fire('Selamat!', 'Anggota Tim berhasil ditambahkan.', 'succes').then(function () {
                    location.reload();
                });
            })
            .catch((err) => {
                swal.fire('Anggota Tim gagal ditambahkan!', 'Pastikan mengisi data seluruhnya.', 'warning');
            });
    });

      //delete pop up
      $('.hapusBtn').on('click', function (e) {
    e.preventDefault();
    let idTM = $(this).attr('idTM');
    let nisnPemain = $(this).data('nisn-pemain'); // Get nisn_pemain from data attribute

    swal.fire({
        title: "Apakah anda ingin menghapus data ini?",
        showCancelButton: true,
        confirmButtonText: 'Setuju',
        cancelButtonText: `Batal`,
        confirmButtonColor: 'red'
    }).then((result) => {
        if (result.isConfirmed) {
            // Include nisn_pemain in the DELETE request
            axios.delete(`/tim/hapus/anggota/${idTM}`, { data: { nisn_pemain: nisnPemain } })
            .then(function (response) {
                console.log(response);
                // if (response.data.success) {
                    swal.fire('Berhasil di hapus!', '', 'success').then(function () {
                        // Refresh Halaman
                        location.reload();
                    });
                // } else {
                    // swal.fire('Gagal di hapus!', '', 'warning').then(function () {
                        // Refresh Halaman
                        // location.reload();
                    // });
                // }
            }).catch(function (error) {
                swal.fire('Data gagal di hapus!', '', 'error').then(function () {
                    // Refresh Halaman
                });
            });
        }
    });
});

    $('.DataTable').DataTable();
    </script>
@endsection