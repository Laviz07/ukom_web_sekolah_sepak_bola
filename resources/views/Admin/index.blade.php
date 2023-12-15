@extends('layouts.layout')
@section('title', 'List Admin')
@section('content')   

<div class="container mt-4 mb-4">

    {{-- LIST PELATIH --}}
    <div>
        <div class="card align-items-center" style="border: 2px solid #00171F;">
            <div class="card-body">
                <span class="h3 text-uppercase "> <strong>Daftar Admin</strong></span>
            </div>
        </div>

        <div class=" mt-3">
                <table class="table table-hovered table-bordered DataTable  ">
                    <thead>
                        <tr style="text-align: center; font-size: 17px; font-weight: 600;">
                            <td>No</td>
                            <td>Foto</td>
                            <td>Nama</td>
                            <td>Username</td>
                            <td>NIK</td>
                            <td>No. Telp</td>
                            <td>Email</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                        ?>

                    @foreach ($admin as $ad)

                        <tr style="vertical-align: middle; font-size: 17px;" idAD{{$ad->nik_admin}}>
                            <td class="col-0" style="text-align: center;"> {{$no++}} </td>
                            <td class="col-1" style="text-align: center"> 
                                @if ($ad->user && $ad->user->foto_profil)
                                    <img src="{{asset('storage/' . $ad->user->foto_profil) }}" alt="Foto Profil" style="width: 90px; height: 90px;" class="rounded-circle">
                                @else
                                    <i class="bi bi-person-circle"  style="font-size: 40px;"></i> 
                                @endif
                            </td>
                            <td class="col-2 text-capitalize text-center"> {{$ad->nama_admin}} </td>
                            <td class="col-1 text-capitalize text-center"> {{$ad->user->username}} </td>
                            <td class="col-1" style="text-align: center"> {{$ad->nik_admin}} </td>
                            <td class="col-2" style="text-align: center"> 0{{$ad->no_telp}} </td>
                            <td class="col-2" style="text-align: center"> {{$ad->email}} </td>
                            <td style="text-align: center">
                                
                                <div class="dropdown dropend" style="display: inline-block; vertical-align: middle;">
                                    <button class="btn btn-primary" id="navbarDropdownMenuLink" data-bs-toggle='dropdown' data-bs-offset="-10,20">
                                        Action
                                        <i  class="bi bi-three-dots-vertical " 
                                            style="font-size: 26; vertical-align: middle; cursor: pointer;">
                                        </i>
                                    </button>

                                    <div class="dropdown-menu" style="width: 200px;" aria-labelledby="navbarDropdownMenuLink">
                                    
                                    <h6 class="dropdown-header">Apa Yang Akan Anda Lakukan?</h6>
                                        

                                       <a class="dropdown-item editBtn" data-bs-toggle="modal" data-bs-target="#edit-modal-{{$ad->nik_admin}}" 
                                        style="cursor: pointer" idAD = {{$ad->nik_admin}} > 
                                        <i class="bi bi-pencil"  style="font-size: 20px; vertical-align: middle; "></i> 
                                        <strong class="ms-1" >Edit Data Admin</strong> 
                                       </a>

                                       <a class="dropdown-item hapusBtn" idAD={{$ad->nik_admin}} style="cursor: pointer"> 
                                        <i class="bi bi-trash"  style="font-size: 20px; vertical-align: middle; "></i> 
                                        <strong class="ms-1">Hapus Data Admin</strong> 
                                       </a>

                                    </div>

                                </div>

                            </td>
                        </tr>

                        {{-- EDIT ADMIN --}}
                        <div class="modal fade" id="edit-modal-{{$ad->nik_admin}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Admin</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form id="edit-ad-form-{{$ad->nik_admin}}">
                                            <div class="form-group">
                                                <label>Nama Admin</label>
                                                <input placeholder="example" type="text" class="form-control mb-3"
                                                        name="nama_admin"
                                                        value="{{$ad->nama_admin}}"
                                                        required/>
                                                @csrf
                                            </div>

                                            

                                            {{-- <div class="form-group">
                                                <label>No. Telepon:</label>
                                                <input placeholder="example" type="number" class="form-control mb-3"
                                                        name="no_telp"
                                                        value="{{$ad->no_telp}}"
                                                        required/>
                                            </div> --}}

                                            <div class="form-group mt-2">
                                                <label >No. Telepon:</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text" >+62</span>
                                                    <input  type="number" class="form-control" placeholder="81234567890"
                                                    name="no_telp" value="{{$ad->no_telp}}" required/>
                                                  </div>
                                            </div>


                                            <div class="form-group">
                                                <label>Email:</label>
                                                <input placeholder="example" type="email" class="form-control mb-3"
                                                        name="email"
                                                        value="{{$ad->email}}"
                                                        required/>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary edit-btn"
                                                form="edit-ad-form-{{$ad->nik_admin}}">
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
    @if (Auth::check() && Auth::user()->role == 'admin')
    <a href="{{ url('admin', ['tambah']) }}" class="position-fixed z-10 bottom-0 end-0">
        <i class="bi bi-plus-circle-fill bi-3x" style="font-size: 35px; margin: 30px; color:#003459;"></i>
    </a>@endif
</div>
@endsection

@section('footer')
    <script type="module">

        // edit pop up
        $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idAD = $(this).attr('idAD');
            $(`#edit-ad-form-${idAD}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['nik_admin'] = idAD;
                axios.post(`/admin/edit/${idAD}`, data)
                    .then(() => {
                        $(`#edit-modal-${idAD}`).css('display', 'none')
                        swal.fire('Berhasil edit data!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Gagal edit data!', '', 'warning');
                    })
            })
        })
        
        //delete pop up
        $('.DataTable tbody').on('click','.hapusBtn',function(a){
        a.preventDefault();
        let idAD = $(this).closest('.hapusBtn').attr('idAD');
        swal.fire({
                title : "Apakah anda ingin menghapus data ini?",
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
    
            }).then((result)=>{
                if(result.isConfirmed){
                    //dilakukan proses hapus
                    axios.delete('/admin/hapus/' + idAD).then(function(response){
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