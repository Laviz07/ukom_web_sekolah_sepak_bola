@extends('layouts.layout')
@section('title', 'List Pelatih')
@section('content')   

<div class="container mt-4 mb-4">

    {{-- LIST PELATIH --}}
    <div>
        <div class="card align-items-center" style="border: 2px solid #00171F;">
            <div class="card-body">
                <span class="h3 text-uppercase "> <strong>Daftar Pelatih</strong></span>
            </div>
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

                        <tr style="vertical-align: middle; font-size: 17px;" idPl{{$pl->nik_pelatih}}>
                            <td class="col-1" style="text-align: center;"> {{$no++}} </td>
                            <td class="col-1" style="text-align: center"> 
                                @if ($pl->user->foto_profil)
                                    <img src="{{asset('storage/' . $pl->user->foto_profil) }}" alt="Foto Profil" style="width: 90px; height: 90px;" class="rounded-circle">
                                @else
                                    <i class="bi bi-person-circle"  style="font-size: 40px;"></i> 
                                @endif
                            </td>
                            <td class="col-5 text-capitalize text-center"> {{$pl->nama_pelatih}} </td>
                            <td class="col-2" style="text-align: center"> {{$pl->nik_pelatih}} </td>
                            <td style="text-align: center">
                                
                            @if (Auth::user()['role']=='admin')
                                <div class="dropdown dropend" style="display: inline-block; vertical-align: middle;">
                                    <button class="btn btn-primary" id="navbarDropdownMenuLink" data-bs-toggle='dropdown' data-bs-offset="-10,20">
                                        Action
                                        <i  class="bi bi-three-dots-vertical " 
                                            style="font-size: 26; vertical-align: middle; cursor: pointer;">
                                        </i>
                                    </button>

                                    <div class="dropdown-menu" style="width: 200px;" aria-labelledby="navbarDropdownMenuLink">
                                    
                                    <h6 class="dropdown-header">Apa Yang Akan Anda Lakukan?</h6>
                                        <a class="dropdown-item" href="{{ url('pelatih', ['detail', $pl->nik_pelatih]) }}">
                                        <i class="bi bi-eye"  style="font-size: 20px; vertical-align: middle; "></i> 
                                        <strong class="ms-1">Lihat Detail Pelatih</strong> 
                                       </a>

                                       <a class="dropdown-item editBtn" data-bs-toggle="modal" data-bs-target="#edit-modal-{{$pl->nik_pelatih}}" 
                                        style="cursor: pointer" idPL = {{$pl->nik_pelatih}} > 
                                        <i class="bi bi-pencil"  style="font-size: 20px; vertical-align: middle; "></i> 
                                        <strong class="ms-1" >Edit Data Pelatih</strong> 
                                       </a>

                                       <a class="dropdown-item hapusBtn" idPL={{$pl->nik_pelatih}} style="cursor: pointer"> 
                                        <i class="bi bi-trash"  style="font-size: 20px; vertical-align: middle; "></i> 
                                        <strong class="ms-1">Hapus Data Pelatih</strong> 
                                       </a>
                                    </div>

                                </div>
                            @endif

                            @if (Auth::user()['role']!='admin')
                            <a href="{{ url('pelatih', ['detail', $pl->nik_pelatih]) }}" class="btn btn-primary" >
                                Lihat Detail
                                <i class="bi bi-search ms-2"  style="font-size: 15px; vertical-align: middle; "></i> 
                            </a>
                            @endif
                            </td>
                        </tr>

                        {{-- EDIT PELATIH --}}
                        <div class="modal fade" id="edit-modal-{{$pl->nik_pelatih}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pelatih</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form id="edit-pl-form-{{$pl->nik_pelatih}}">
                                            <input type="hidden" value="{{Auth::user()->id_user}}" name="id_user">
                                            <div class="form-group">
                                                <label>Nama Pelatih</label>
                                                <input placeholder="example" type="text" class="form-control mb-3"
                                                        name="nama_pelatih"
                                                        value="{{$pl->nama_pelatih}}"
                                                        required/>
                                                @csrf
                                            </div>

                                            <div class="form-group">
                                                <label>Alamat:</label>
                                                <textarea required name="alamat" id="" class="form-control" rows="3" 
                                                placeholder="Deskripsi Diri" style="resize: none">{{$pl->alamat}}</textarea>
                                
                                            </div>

                                            <div class="form-group">
                                                <label>No. Telepon:</label>
                                                <input placeholder="example" type="number" class="form-control mb-3"
                                                        name="no_telp"
                                                        value="{{$pl->no_telp}}"
                                                        required/>
                                            </div>

                                            <div class="form-group">
                                                <label>Email:</label>
                                                <input placeholder="example" type="email" class="form-control mb-3"
                                                        name="email"
                                                        value="{{$pl->email}}"
                                                        required/>
                                            </div>

                                            <div class="form-group">
                                                <label>Deskripsi Diri:</label>
                                                <textarea required name="deskripsi_pelatih" id="" 
                                                    class="form-control" rows="5" placeholder="Deskripsi Diri" 
                                                    style="resize: none">{{$pl->deskripsi_pelatih}}
                                                </textarea>
                                
                                               
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary edit-btn"
                                                form="edit-pl-form-{{$pl->nik_pelatih}}">
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
<div class="col d-flex justify-content-end mb-2 mt-3">
    @if (Auth::check() && Auth::user()->role == 'admin' )
    <a href="{{ url('pelatih', ['tambah']) }}" class="position-fixed z-10 bottom-0 end-0">
        <i class="bi bi-plus-circle-fill bi-3x" style="font-size: 35px; margin: 30px; color:#003459;"></i>
    </a>@endif
    @if (Auth::check() && Auth::user()->role == 'admin' || Auth::user()->role == 'pelatih')
    <a href="{{url('pelatih', ['cetak'])}}" target="blank" class="position-fixed z-10  end-0 " style="bottom: 50px">
        <i class="bi bi-printer-fill" style="font-size: 35px; margin: 30px; color:#003459;"></i>
    </a>@endif
</div>
@endsection

@section('footer')
    <script type="module">

        // edit pop up
        $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idPL = $(this).attr('idPL');
            $(`#edit-pl-form-${idPL}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['nik_pelatih'] = idPL;
                axios.post(`/pelatih/edit/${idPL}`, data)
                    .then(() => {
                        $(`#edit-modal-${idPL}`).css('display', 'none')
                        swal.fire('Selamat!', 'Pelatih berhasil diedit.', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Waduh!', 'Pelatih gagal diedit.', 'warning');
                    })
            })
        })
        
        //delete pop up
        $('.DataTable tbody').on('click','.hapusBtn',function(a){
        a.preventDefault();
        let idPL = $(this).closest('.hapusBtn').attr('idPL');
        swal.fire({
                title: "Yakin ingin menghapus pelatih?",
                text: 'Pelatih yang sudah dihapus, tidak bisa dikembalikan.',
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
    
            }).then((result)=>{
                if(result.isConfirmed){
                    //dilakukan proses hapus
                    axios.delete('/pelatih/hapus/' + idPL).then(function(response){
                        console.log(response);
                        if(response.data.success){
                            swal.fire('Selamat!', 'Pelatih berhasil dihapus.', 'success').then(function(){
                                    //Refresh Halaman
                                    location.reload();
                                });
                        }else{
                            swal.fire('Waduh!', 'Pelatih gagal dihapus.', 'warning').then(function(){
                                    //Refresh Halaman
                                    location.reload();
                                });
                        }
                    }).catch(function(error){
                        swal.fire('Waduh!', 'Pelatih gagal dihapus.', 'error').then(function(){
                                    //Refresh Halaman
                                   
                                });
                    });
                }
            });
    });

        $('.DataTable').DataTable();
    </script>
@endsection