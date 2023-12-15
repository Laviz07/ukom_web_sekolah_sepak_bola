@extends('layouts.layout')
@section('title', 'List Pemain')
@section('content')   

<div class="container mt-4 mb-4">

    {{-- LIST PEMAIN --}}
    <div>
        <div class="card align-items-center" style="border: 2px solid #00171F;">
            <div class="card-body">
                <span class="h3 text-uppercase "> <strong>Daftar Pemain</strong></span>
            </div>
        </div>

        <div class=" mt-3">
                <table class="table table-hovered table-bordered DataTable  ">
                    <thead>
                        <tr style="text-align: center; font-size: 17px; font-weight: 600;">
                            <td>No</td>
                            <td>Foto</td>
                            <td>Nama</td>
                            <td>NISN</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                        ?>

                @foreach ($pemain as $pm)
                    
                        <tr style="vertical-align: middle; font-size: 17px;" idPm={{$pm->nisn_pemain}}>
                            <td class="col-1" style="text-align: center;"> {{$no++}} </td>
                            <td class="col-1" style="text-align: center"> 
                                @if ($pm->user->foto_profil)
                                    <img src="{{asset('storage/' . $pm->user->foto_profil) }}" alt="Foto Profil" style="width: 90px; height: 90px;" class="rounded-circle">
                                @else
                                    <i class="bi bi-person-circle"  style="font-size: 40px;"></i> 
                                @endif
                            </td>
                            <td class="col-5 text-capitalize text-center "> {{$pm->nama_pemain}} </td>
                            <td class="col-2" style="text-align: center"> {{$pm->nisn_pemain}} </td>
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
                                       <a class="dropdown-item" href="{{ url('pemain', ['detail', $pm->nisn_pemain]) }}"> 
                                        <i class="bi bi-eye"  style="font-size: 20px; vertical-align: middle; "></i> 
                                        <strong class="ms-1">Lihat Detail Pemain</strong> 
                                       </a>

                                        <a class="dropdown-item editBtn" data-bs-toggle="modal" data-bs-target="#edit-modal-{{$pm->nisn_pemain}}" 
                                            style="cursor: pointer" idPM = {{$pm->nisn_pemain}} > 
                                            <i class="bi bi-pencil"  style="font-size: 20px; vertical-align: middle; "></i> 
                                            <strong class="ms-1" >Edit Data Pemain</strong> 
                                        </a>

                                        <a class="dropdown-item hapusBtn" idPM={{$pm->nisn_pemain}} style="cursor: pointer"> 
                                            <i class="bi bi-trash"  style="font-size: 20px; vertical-align: middle; "></i> 
                                            <strong class="ms-1">Hapus Data Pemain</strong> 
                                        </a>

                                    </div>

                                </div>
                            @endif

                            @if (Auth::user()['role']!='admin')
                                <a href="{{ url('pemain', ['detail', $pm->nisn_pemain]) }}" class="btn btn-primary" >
                                    Lihat Detail
                                    <i class="bi bi-search ms-2"  style="font-size: 15px; vertical-align: middle; "></i> 
                                </a>
                            @endif

                            </td>
                        </tr>

                         {{-- EDIT PEMAIN --}}
                        <div class="modal fade" id="edit-modal-{{$pm->nisn_pemain}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pemain</h1>
                                    </div>
                                    <div class="modal-body">
                                        <form id="edit-pm-form-{{$pm->nisn_pemain}}">
                                            <div class="form-group">
                                                <label>Nama Pemain:</label>
                                                <input placeholder="example" type="text" class="form-control mb-3"
                                                        name="nama_pemain"
                                                        value="{{$pm->nama_pemain}}"
                                                        required/>
                                                @csrf
                                            </div>

                                            <div class="form-group">
                                                <label>Alamat:</label>
                                                <textarea required name="alamat" id="" class="form-control" rows="3" 
                                                placeholder="Deskripsi Diri" style="resize: none">{{$pm->alamat}}</textarea>
                                
                                            </div>

                                            <div class="form-group mt-2">
                                                <label >No. Telepon:</label>
                                                <div class="input-group mb-2">
                                                    <span class="input-group-text" >+62</span>
                                                    <input  type="number" class="form-control" placeholder="81234567890"
                                                    name="no_telp" value="{{$pm->no_telp}}" required/>
                                                  </div>
                                            </div>

                                            <div class="form-group">
                                                <label>Email:</label>
                                                <input placeholder="example" type="email" class="form-control mb-3"
                                                        name="email"
                                                        value="{{$pm->email}}"
                                                        required/>
                                               
                                            </div>

                                            <div class="form-group">
                                                <label>Deskripsi Diri:</label>
                                                <textarea required name="deskripsi_pemain" id="" 
                                                    class="form-control" rows="5" placeholder="Deskripsi Diri" 
                                                    style="resize: none">{{$pm->deskripsi_pemain}}
                                                </textarea>
                                
                                               
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary edit-btn"
                                                form="edit-pm-form-{{$pm->nisn_pemain}}" >
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
    <a href="{{ url('pemain', ['tambah']) }}" class="position-fixed z-10 bottom-0 end-0">
        <i class="bi bi-plus-circle-fill bi-3x" style="font-size: 35px; margin: 30px; color:#003459;"></i>
    </a>@endif
    @if (Auth::check() && Auth::user()->role == 'admin' || Auth::user()->role == 'pelatih')
    <a href="{{url('pemain', ['cetak'])}}" target="blank" class="position-fixed z-10 end-0" style="bottom: 50px">
        <i class="bi bi-printer-fill" style="font-size: 35px; margin: 30px; color:#003459;"></i>
    </a> @endif
</div>
@endsection

@section('footer')
    <script type="module">

        // edit pop up
        $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idPM = $(this).attr('idPM');
            $(`#edit-pm-form-${idPM}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['nisn_pemain'] = idPM;
                axios.post(`/pemain/edit/${idPM}`, data)
                    .then(() => {
                        $(`#edit-modal-${idPM}`).css('display', 'none')
                        swal.fire('Selamat!', 'Pemain berhasil diedit.', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Waduh!', 'Pemain gagal diedit.', 'warning');
                    })
            })
        })
        
        //delete pop up
        $('.DataTable tbody').on('click','.hapusBtn',function(a){
        a.preventDefault();
        let idPM = $(this).closest('.hapusBtn').attr('idPM');
        swal.fire({
                title: "Yakin ingin menghapus pemain?",
                text: 'Pemain yang sudah dihapus, tidak bisa dikembalikan.',
                showCancelButton: true,
                confirmButtonText: 'Setuju',
                cancelButtonText: `Batal`,
                confirmButtonColor: 'red'
    
            }).then((result)=>{
                if(result.isConfirmed){
                    //dilakukan proses hapus
                    axios.delete('/pemain/hapus/' + idPM).then(function(response){
                        console.log(response);
                        if(response.data.success){
                            swal.fire('Selamat!', 'Pemain berhasil dihapus.', 'success').then(function(){
                                    //Refresh Halaman
                                    location.reload();
                                });
                        }else{
                            swal.fire('Waduh!', 'Pemain gagal dihapus.', 'warning').then(function(){
                                    //Refresh Halaman
                                    location.reload();
                                });
                        }
                    }).catch(function(error){
                        swal.fire('Waduh!', 'Pemain gagal dihapus.', 'error').then(function(){
                                    //Refresh Halaman
                                   
                                });
                    });
                }
            });
    });

        $('.DataTable').DataTable();
    </script>
@endsection