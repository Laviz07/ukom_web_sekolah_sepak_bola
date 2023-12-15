@extends('layouts.layout')
@section('title', $user->username)

{{-- GAK DIPAKE, PAKE YANG DI FOLDER PROFIL --}}

@section('content')

@if (Auth::user()['role']=='pemain' )

<div class="container mt-4 mb-4">
    <div class="row mt-4 d-flex justify-content-between">
        <div class="col-md-4 card">
            <div class="row p-4 d-flex flex-column align-items-center justify-content-center">
                <div class="text-center">
                    <img src="{{ asset('storage/' . $user->pemain->user->foto_profil) }}" alt="{{$user->pemain->nama_pemain}}" class="rounded-circle" style="width: 170px; height: 170px;">
                </div>
                <div class="mt-4 ">
                    <div class="row">
                        <span class="text-capitalize" style="font-weight: 800; font-size: 26px; line-height:normal">
                            {{$user->pemain->nama_pemain}}
                        </span>

                        <span 
                        style="font-weight: 400; font-size: 20px; color:#5b5b5b" >@ {{$user->username}}
                        </span>
                    </div>
                    <div class="row mt-2 ">
                        <span>
                            <span class="fw-bold ">NISN </span>
                            <span class="ms-3 ">: {{$user->pemain->nisn_pemain}}</span> 
                        </span>

                        <span> 
                            <span class="fw-bold "> No.Telp </span>: 
                            0{{$user->pemain->no_telp}}
                        </span>

                        <span>
                            <span class="fw-bold ">Email </span>
                            <span style="margin-left: 13px">: {{$user->pemain->email}}</span> 
                        </span>

                        <button class="btn btn-primary mt-4 editBtn" 
                        data-bs-toggle="modal" data-bs-target="#editProfil-modal-{{$user->pemain->nisn_pemain}}"
                        idPL = {{$user->pemain->nisn_pemain}}>
                            Edit Profil
                        </button>

                        <button class="btn btn-primary mt-2 editBtn" style="width: 47%;" 
                        data-bs-toggle="modal" data-bs-target="#editUsername-modal-{{$user->id_user}}"
                        idUser = {{$user->id_user}}>
                            Edit Username
                        </button>

                        <button class="btn btn-primary mt-2 editBtn"  style="width: 47%; margin-left: 5%"
                        data-bs-toggle="modal" data-bs-target="#editPassword-modal-{{$user->id_user}}"
                        idUser = {{$user->id_user}}>
                            Ganti Password
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
        

        <div class="col-md-8 card" style="width: 65%">
            <div class="row p-3">
                <span style="font-size:24px; font-weight: 700">Detail Anda:</span>

                <div class="row mt-3">
                    <span style="font-size: 17px; font-weight: 600;">Tempat, Tanggal Lahir:</span>
                    <span style="font-size: 17px;"> {{$user->pemain->tempat_lahir}}, {{$user->pemain->tanggal_lahir}} </span>
                </div>

                <div class="row mt-3">
                    <span style="font-size: 17px; font-weight: 600;">Alamat:</span>
                    <span style="font-size: 17px;line-height: normal"> {{$user->pemain->alamat}}</span>
                </div>

                <div class="row mt-3">
                    <span style="font-size: 17px; font-weight: 600;">Deskripsi Diri:</span>
                    <span style="font-size: 17px; line-height: normal "> {{$user->pemain->deskripsi_pemain}} </span>
                </div>

                
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4 align-items-center text-center ms-4" style="text-align: center;">
        <div class="row p-4 col-md-4" style="background-color: #7FDEFF">
            <span class="text-uppercase" style="font-size:40px; font-weight:700;"> 
                {{$user->pemain->no_punggung}} 
            </span>
            <span style="font-size:16px; font-weight:700;">No Punggung</span>
        </div>

        <div class="row p-4 col-md-4" style="background-color: #DFFFFD">
            <span class="text-uppercase" style="font-size:40px; font-weight:700;">
                @if ($user->pemain->tim)
                    @if ($user->pemain->tim->id_tim)
                        {{ $user->pemain->tim->nama_tim }}
                    @else
                        No Team
                    @endif
                    @else
                    No Team
                @endif
            </span>
            <span class="mt-2" style="font-size:16px; font-weight:700;">Nama Tim</span>
        </div>

        <div class="row p-4 col-md-4" style="background-color: #7FDEFF">
            <span class="text-uppercase" style="font-size:40px; font-weight:700;"> 
                {{$user->pemain->posisi}} 
            </span>
            <span  class="mt-2" style="font-size:16px; font-weight:700;">Posisi</span>
        </div>
    </div>
</div>

  {{-- EDIT PEMAIN --}}
  <div class="modal fade" id="edit-modal-{{$user->pemain->nisn_pemain}}" tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pemain</h1>
        </div>
        <div class="modal-body">
            <form id="edit-pm-form-{{$user->pemain->nisn_pemain}}">
                <div class="form-group">
                    <label>Nama Pemain:</label>
                    <input placeholder="example" type="text" class="form-control mb-3"
                            name="nama_pemain"
                            value="{{$user->pemain->nama_pemain}}"
                            required/>
                    @csrf
                </div>

                <div class="form-group">
                    <label>Alamat:</label>
                    <textarea required name="alamat" id="" class="form-control" rows="3" 
                    placeholder="Deskripsi Diri" style="resize: none">{{$user->pemain->alamat}}</textarea>
    
                </div>

                <div class="form-group">
                    <label>No. Telepon:</label>
                    <input placeholder="example" type="number" class="form-control mb-3"
                            name="no_telp"
                            value="{{$user->pemain->no_telp}}"
                            required/>
                </div>

                <div class="form-group">
                    <label>Email:</label>
                    <input placeholder="example" type="email" class="form-control mb-3"
                            name="email"
                            value="{{$user->pemain->email}}"
                            required/>
                   
                </div>

                <div class="form-group">
                    <label>Deskripsi Diri:</label>
                    <textarea required name="deskripsi_pemain" id="" 
                        class="form-control" rows="5" placeholder="Deskripsi Diri" 
                        style="resize: none">{{$user->pemain->deskripsi_pemain}}
                    </textarea> 
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Cancel
            </button>
            <button type="submit" class="btn btn-primary edit-btn"
                    form="edit-pm-form-{{$user->pemain->nisn_pemain}}" >
                Edit
            </button>
        </div>
    </div>
</div>
</div>

 {{-- EDIT USERNAME--}}
 <div class="modal fade" id="editUsername-modal-{{$user->id_user}}" tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Username Pelatih</h1>
        </div>
        <div class="modal-body">
            <form id="edit-un-form-{{$user->id_user}}">
                <div class="form-group">
                    <label>Username Anda</label>
                    <input placeholder="example" type="text" class="form-control mb-3"
                            name="username"
                            value="{{$user->username}}"
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
                        form="edit-un-form-{{$user->id_user}}">
                    Edit
                </button>
            </div>
        </div>
    </div>
</div>

{{-- EDIT PASSWORD --}}
<div class="modal fade" id="editPassword-modal-{{$user->id_user}}" tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Password</h1>
        </div>
        <div class="modal-body">
            <form id="edit-pw-form-{{$user->id_user}}">
                <div class="form-group">
                    <label>Password Baru:</label>
                    <input placeholder="Masukkan Password" type="text" class="form-control mb-3"
                            name="password"
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
                        form="edit-pw-form-{{$user->id_user}}">
                    Edit
                </button>
            </div>
        </div>
    </div>

@elseif(Auth::user()['role']=='pelatih')


<div class="container mt-4 mb-4">
    <div class="row mt-4 d-flex justify-content-between">
        <div class="col-md-4 card">
            <div class="row p-4 d-flex flex-column align-items-center justify-content-center">
                <div class="text-center">
                    <img src="{{ asset('storage/' . $user->pelatih->user->foto_profil) }}" alt="{{$user->pelatih->nama_pelatih}}" class="rounded-circle" style="width: 170px; height: 170px;">
                </div>
                <div class="mt-4 ">
                    <div class="row">
                        <span class="text-capitalize" style="font-weight: 800; font-size: 26px; line-height:normal">
                            {{$user->pelatih->nama_pelatih}}
                        </span>

                        <span 
                        style="font-weight: 400; font-size: 20px; color:#5b5b5b" >@ {{$user->username}}
                        </span>
                    </div>
                    <div class="row mt-2 ">
                         <span>
                            <span class="fw-bold ">NIK </span>
                            <span class="ms-4 ">: {{$user->pelatih->nik_pelatih}}</span> 
                        </span>

                        <span> 
                            <span class="fw-bold "> No.Telp </span>: 
                            0{{$user->pelatih->no_telp}}
                        </span>

                        {{--<span>
                            <span class="fw-bold ">Email </span>
                            <span style="margin-left: 13px">: {{$user->pelatih->email}}</span> 
                        </span> --}}

                        <button class="btn btn-primary mt-4 editBtn" 
                        data-bs-toggle="modal" data-bs-target="#editProfil-modal-{{$user->pelatih->nik_pelatih}}"
                        idPL = {{$user->pelatih->nik_pelatih}}>
                            Edit Profil
                        </button>

                        <button class="btn btn-primary mt-2 editBtn" style="width: 47%;" 
                        data-bs-toggle="modal" data-bs-target="#editUsername-modal-{{$user->id_user}}"
                        idUser = {{$user->id_user}}>
                            Edit Username
                        </button>

                        <button class="btn btn-primary mt-2 editBtn"  style="width: 47%; margin-left: 5%"
                        data-bs-toggle="modal" data-bs-target="#editPassword-modal-{{$user->id_user}}"
                        idUser = {{$user->id_user}}>
                            Ganti Password
                        </button>
                        
                    </div>
                </div>
            </div>
        </div>
        

        <div class="col-md-8 card" style="width: 65%">
            <div class="row p-3">
                <span style="font-size:24px; font-weight: 700">Detail Anda:</span>

                {{-- <div class="row mt-3">
                    <span style="font-size: 17px; font-weight: 600;">NIK:</span>
                    <span style="font-size: 17px;"> {{$user->pelatih->nik_pelatih}} </span>
                </div> --}}

                {{-- <div class="row mt-3">
                    <span style="font-size: 17px; font-weight: 600;">No Telp:</span>
                    <span style="font-size: 17px;">  0{{$user->pelatih->no_telp}} </span>
                </div> --}}

                <div class="row mt-3">
                    <span style="font-size: 17px; font-weight: 600;">Email:</span>
                    <span style="font-size: 17px;">{{$user->pelatih->email}} </span>
                </div>

                <div class="row mt-3">
                    <span style="font-size: 17px; font-weight: 600;">Tempat, Tanggal Lahir:</span>
                    <span style="font-size: 17px;"> {{$user->pelatih->tempat_lahir}}, {{$user->pelatih->tanggal_lahir}} </span>
                </div>

                <div class="row mt-3">
                    <span style="font-size: 17px; font-weight: 600;">Alamat:</span>
                    <span style="font-size: 17px;line-height: normal"> {{$user->pelatih->alamat}}</span>
                </div>

                <div class="row mt-3">
                    <span style="font-size: 17px; font-weight: 600;">Deskripsi Diri:</span>
                    <span style="font-size: 17px; line-height: normal "> {{$user->pelatih->deskripsi_pelatih}} </span>
                </div>

                
            </div>
        </div>
    </div>

</div>

{{-- EDIT PROFIL PELATIH --}}
<div class="modal fade" id="editProfil-modal-{{$user->pelatih->nik_pelatih}}" tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pelatih</h1>
            </div>
            <div class="modal-body">
                <form id="edit-pl-form-{{$user->pelatih->nik_pelatih}}">
                    <div class="form-group">
                        <label>Nama Pelatih</label>
                        <input placeholder="example" type="text" class="form-control mb-3"
                                name="nama_pelatih"
                                value="{{$user->pelatih->nama_pelatih}}"
                                required/>
                        @csrf
                    </div>
                    
                    <div class="form-group">
                    <label>Alamat:</label>
                        <textarea required name="alamat" id="" class="form-control" rows="3" 
                            placeholder="Deskripsi Diri" style="resize: none">{{$user->pelatih->alamat}}
                        </textarea>
                    </div>

                    <div class="form-group">
                        <label>No. Telepon:</label>
                        <input placeholder="example" type="number" class="form-control mb-3"
                                name="no_telp"
                                value="{{$user->pelatih->no_telp}}"
                                required/>
                    </div>

                    <div class="form-group">
                    <label>Email:</label>
                        <input placeholder="example" type="email" class="form-control mb-3"
                                name="email"
                                value="{{$user->pelatih->email}}"
                                required/>
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Diri:</label>
                            <textarea required name="deskripsi_pelatih" id="" 
                                class="form-control" rows="5" placeholder="Deskripsi Diri" 
                                style="resize: none">{{$user->pelatih->deskripsi_pelatih}}
                            </textarea>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary edit-btn"
                            form="edit-pl-form-{{$user->pelatih->nik_pelatih}}">
                        Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- EDIT USERNAME--}}
    <div class="modal fade" id="editUsername-modal-{{$user->id_user}}" tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Username Pelatih</h1>
            </div>
            <div class="modal-body">
                <form id="edit-un-form-{{$user->id_user}}">
                    <div class="form-group">
                        <label>Username Anda</label>
                        <input placeholder="example" type="text" class="form-control mb-3"
                                name="username"
                                value="{{$user->username}}"
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
                            form="edit-un-form-{{$user->id_user}}">
                        Edit
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- EDIT PASSWORD PELATIH --}}
    <div class="modal fade" id="editPassword-modal-{{$user->id_user}}" tabindex="-1"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Password</h1>
            </div>
            <div class="modal-body">
                <form id="edit-pw-form-{{$user->id_user}}">
                    <div class="form-group">
                        <label>Password Baru:</label>
                        <input placeholder="Masukkan Password" type="text" class="form-control mb-3"
                                name="password"
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
                            form="edit-pw-form-{{$user->id_user}}">
                        Edit
                    </button>
                </div>
            </div>
        </div>
   

@else
    
{{$user->username}} <br>
{{$user->admin->nama_admin}}


@endif


@endsection
@section('footer')
    <script type="module">
         // pop up edit profil pemain
         $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idPM = $(this).attr('idPM');
            $(`#edit-pm-form-${idPM}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['nisn_pemain'] = idPM;
                axios.post(`/profil/pemain/edit/${idPM}`, data)
                    .then(() => {
                        $(`#edit-modal-${idPM}`).css('display', 'none')
                        swal.fire('Berhasil edit data!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Gagal edit data!', '', 'warning');
                    })
            })
        })

          // pop up edit profil pelatih
          $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idPL = $(this).attr('idPL');
            $(`#edit-pl-form-${idPL}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['nik_pelatih'] = idPL;
                axios.post(`/profil/pelatih/edit/${idPL}`, data)
                    .then(() => {
                        $(`#edit-modal-${idPL}`).css('display', 'none')
                        swal.fire('Berhasil edit data!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Gagal edit data!', '', 'warning');
                    })
            })
        })

          // pop up edit username
          $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idUser = $(this).attr('idUser');
            $(`#edit-un-form-${idUser}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['id_user'] = idUser;
                axios.post(`/profil/edit/username/${idUser}`, data)
                    .then(() => {
                        $(`#editUsername-modal-${idUser}`).css('display', 'none')
                        swal.fire('Berhasil edit data!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Gagal edit data!', '', 'warning');
                    })
            })
        })

         // pop up edit password
         $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idUser = $(this).attr('idUser');
            $(`#edit-pw-form-${idUser}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['id_user'] = idUser;
                axios.post(`/profil/edit/password/${idUser}`, data)
                    .then(() => {
                        $(`#editPassword-modal-${idUser}`).css('display', 'none')
                        swal.fire('Berhasil edit data!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Gagal edit data!', '', 'warning');
                    })
            })
        })

    </script>
@endsection