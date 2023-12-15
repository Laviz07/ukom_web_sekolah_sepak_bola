@extends('layouts.layout')
@section('title', 'Detail Kegiatan')
@section('content')
<div class="container mt-4 mb-4 ">
    <div class="row text-center">
        <span style="font-size: 45px; font-weight: 600;" class="text-capitalize "> {{$kegiatan->nama_kegiatan}} </span>
        <div class="mt-0" style="font-size: 16px; font-weight: 400;">
            {{$kegiatan->pelatih->nama_pelatih}} &#8226; 
            {{\Carbon\Carbon::createFromFormat('H:i:s',$kegiatan->jam_mulai)->format('g:i a')}}
            -
            {{\Carbon\Carbon::createFromFormat('H:i:s',$kegiatan->jam_selesai)->format('g:i a')}}
        </div>
    </div>
    <div class="row mt-1">

        <div class="row p-4 d-flex flex-column align-items-center justify-content-center text-center">
            @if ($kegiatan->foto_kegiatan)
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $kegiatan->foto_kegiatan) }}" alt="{{$kegiatan->nama_kegiatan}}" 
                        style="width: auto; height: 350px; border-radius: 10px">
                    </div>
            @endif

            <div class="mt-4">
                <a href="" class="btn btn-primary ">Mengisi Presensi</a>

                @if ($kegiatan->laporan_kegiatan)
                <a class="btn btn-primary ms-3" data-bs-toggle="modal" 
                    data-bs-target="#edit-laporan-modal-{{$kegiatan->id_kegiatan}}" 
                    style="cursor: pointer" idKG={{$kegiatan->id_kegiatan}}>
                        Edit Kegiatan
                </a>
                @else
                <a class="btn btn-primary ms-3" data-bs-toggle="modal" 
                    data-bs-target="#tambah-laporan-modal-{{$kegiatan->id_kegiatan}}" 
                    style="cursor: pointer" idKG={{$kegiatan->id_kegiatan}}>
                        Mengisi Kegiatan
                </a>
                @endif
            </div>
        </div>

        <div class="container mt-2 mb-4 text-center " >
            <div class="row d-flex justify-content-between ">
                <div class="card mt-3 p-3" 
                style="width: 48%;">
                    <span style="font-size: 20px; font-weight: 500; text-align: left"> 
                        Detail Kegiatan
                    </span>

                    <span class="mt-3" style="font-size: 18px; text-align: left">
                        {!! nl2br(e($kegiatan->detail_kegiatan)) !!}
                    </span>
                </div>

                <div class="card mt-3 p-3" 
                style="width: 48%;">
                    <span style="font-size: 20px; font-weight: 500; text-align: left"> 
                        Laporan Kegiatan
                    </span>

                    <span class="mt-3" style="font-size: 18px; text-align: left">
                        @if ($kegiatan->laporan_kegiatan)
                            {!! nl2br(e($kegiatan->laporan_kegiatan)) !!}
                        @else
                            Belum ada laporan kegiatan
                        @endif
                    </span>
                </div>

            </div>
        </div>
    </div>

      {{-- TAMBAH LAPORAN --}}
      <div class="modal fade" id="tambah-laporan-modal-{{$kegiatan->id_kegiatan}}" tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Laporan Kegiatan</h1>
            </div>
            <div class="modal-body">
                <form id="add-lk-form-{{$kegiatan->id_kegiatan}}">
                    <div class="form-group">
                        <label>Laporan Kegiatan:</label>
                        <textarea required name="laporan_kegiatan" id="" 
                            class="form-control" rows="5" placeholder="Laporan Kegiatan" 
                            style="resize: none">
                        </textarea>
                       @csrf
                    </div>
                    <input type="hidden" name="id_kegiatan" value="{{$kegiatan->id_kegiatan}}">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary addBtn"
                        form="add-lk-form-{{$kegiatan->id_kegiatan}}" >
                    Simpan
                </button>
            </div>
        </div>
    </div>
</div>

{{-- EDIT LAPORAN --}}
<div class="modal fade" id="edit-laporan-modal-{{$kegiatan->id_kegiatan}}" tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Laporan Kegiatan</h1>
        </div>
        <div class="modal-body">
            <form id="edit-lk-form-{{$kegiatan->id_kegiatan}}">
                <div class="form-group">
                    <label>Laporan Kegiatan:</label>
                    <textarea required name="laporan_kegiatan" id="" 
                        class="form-control" rows="5" placeholder="Laporan Kegiatan" 
                        style="resize: none"> {{$kegiatan->laporan_kegiatan}}
                    </textarea>
                   @csrf
                </div>
                <input type="hidden" name="id_kegiatan" value="{{$kegiatan->id_kegiatan}}">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Cancel
            </button>
            <button type="submit" class="btn btn-primary editBtn"
                    form="edit-lk-form-{{$kegiatan->id_kegiatan}}" >
                Simpan
            </button>
        </div>
    </div>
</div>
</div>


       {{-- LIST ANGGOTA kegiatan --}}
       {{-- <div>
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
           
    </div> --}}

     {{-- TAMBAH ANGGOTA TIM --}}
     {{-- <div class="modal fade" id="add-modal" tabindex="-1"
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
</div> --}}
    
</div>
@endsection
@section('footer')
    <script type="module" >
        // add pop up
        $('.addBtn').on('click', function (e) {
        e.preventDefault();
        let data = new FormData(e.target.form);
        axios.post(`/jadwal/kegiatan/tambah/laporan-kegiatan/`, data)
            .then((res) => {
                swal.fire('Selamat!', 'Laporan Kegiatan berhasil ditambahkan.', 'success').then(function () {
                    location.reload();
                });
            })
            .catch((err) => {
                swal.fire('Laporan Kegiatan gagal ditambahkan!', 'Pastikan mengisi data seluruhnya.', 'warning');
            });
    });

    $('.editBtn').on('click', function (e) {
        e.preventDefault();
        let data = new FormData(e.target.form);
        axios.post(`/jadwal/kegiatan/tambah/laporan-kegiatan/`, data)
            .then((res) => {
                swal.fire('Selamat!', 'Laporan Kegiatan berhasil diedit.', 'success').then(function () {
                    location.reload();
                });
            })
            .catch((err) => {
                swal.fire('Laporan Kegiatan gagal diedit!', 'Pastikan mengisi data seluruhnya.', 'warning');
            });
    });

//       //delete pop up
//       $('.hapusBtn').on('click', function (e) {
//     e.preventDefault();
//     let idTM = $(this).attr('idTM');
//     let nisnPemain = $(this).data('nisn-pemain'); // Get nisn_pemain from data attribute

//     swal.fire({
//         title: "Apakah anda ingin menghapus data ini?",
//         showCancelButton: true,
//         confirmButtonText: 'Setuju',
//         cancelButtonText: `Batal`,
//         confirmButtonColor: 'red'
//     }).then((result) => {
//         if (result.isConfirmed) {
//             // Include nisn_pemain in the DELETE request
//             axios.delete(`/tim/hapus/anggota/${idTM}`, { data: { nisn_pemain: nisnPemain } })
//             .then(function (response) {
//                 console.log(response);
//                 // if (response.data.success) {
//                     swal.fire('Berhasil di hapus!', '', 'success').then(function () {
//                         // Refresh Halaman
//                         location.reload();
//                     });
//                 // } else {
//                     // swal.fire('Gagal di hapus!', '', 'warning').then(function () {
//                         // Refresh Halaman
//                         // location.reload();
//                     // });
//                 // }
//             }).catch(function (error) {
//                 swal.fire('Data gagal di hapus!', '', 'error').then(function () {
//                     // Refresh Halaman
//                 });
//             });
//         }
//     });
// });

    $('.DataTable').DataTable();
    </script>
@endsection