@section('content')
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
                            <a href="https://wa.me/62{{$user->pemain->no_telp}}" style="text-decoration: none">
                                0{{$user->pemain->no_telp}}
                            </a>
                        </span>


                        <span>
                            <span class="fw-bold ">Email </span>
                            <span style="margin-left: 13px">: {{$user->pemain->email}}</span> 
                        </span>

                        <div class="dropdown dropend" style="display: inline-block; vertical-align: middle;">
                            <button class="btn btn-primary mt-4" style="width: 100%" id="navbarDropdownMenuLink" data-bs-toggle='dropdown' data-bs-offset="-10,20">
                                Edit Profil Anda
                                <i class="bi bi-pencil ms-2 "></i> 
                            </button>

                            <div class="dropdown-menu" style="width: 200px;" aria-labelledby="navbarDropdownMenuLink">
                            
                            <h6 class="dropdown-header">Apa Yang Akan Anda Lakukan?</h6>
                              

                               <a class="dropdown-item editBtn" 
                                data-bs-toggle="modal" data-bs-target="#editProfil-modal-{{$user->pemain->nisn_pemain}}"
                                idPM = {{$user->pemain->nisn_pemain}} style="cursor: pointer" > 
                                    <i class="bi bi-person-lines-fill"  style="font-size: 20px; vertical-align: middle; "></i> 
                                    <strong class="ms-1" >Edit Biodata Anda</strong> 
                               </a>

                               <a class="dropdown-item editBtn" 
                                data-bs-toggle="modal" data-bs-target="#editUsername-modal-{{$user->id_user}}"
                                idUser = {{$user->id_user}} style="cursor: pointer" > 
                                    <i class="bi bi-pencil-square"  style="font-size: 20px; vertical-align: middle; "></i> 
                                    <strong class="ms-1" >Edit Username Anda</strong> 
                               </a>

                               <a class="dropdown-item editBtn" 
                                data-bs-toggle="modal" data-bs-target="#editPassword-modal-{{$user->id_user}}"
                                idUser = {{$user->id_user}} style="cursor: pointer" > 
                                    <i class="bi bi-key-fill"  style="font-size: 20px; vertical-align: middle; "></i> 
                                    <strong class="ms-1" >Edit Password Anda</strong> 
                               </a>

                               <a class="dropdown-item editBtn" 
                                data-bs-toggle="modal" data-bs-target="#editFotoProfil-modal-{{$user->id_user}}"
                                idUser = {{$user->id_user}} style="cursor: pointer" > 
                                    <i class="bi bi-image-fill"  style="font-size: 20px; vertical-align: middle; "></i> 
                                    <strong class="ms-1" >Edit Foto Profil Anda</strong> 
                               </a>

                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        

        <div class="col-md-8 card" style="width: 65%">
            <div class="row p-3">
                <span style="font-size:24px; font-weight: 700">Detail Anda:</span>

                <div class="row mt-3">
                    <span style="font-size: 17px; font-weight: 600;">Tempat, Tanggal Lahir:</span>
                    <span style="font-size: 17px;"> 
                        {{$user->pemain->tempat_lahir}}, 
                       {{\Carbon\Carbon::parse($user->pemain->tanggal_lahir)->format('j F Y') }}
                    </span>
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
  <div class="modal fade" id="editProfil-modal-{{$user->pemain->nisn_pemain}}" tabindex="-1"
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
                    placeholder="Alamat" style="resize: none">{{$user->pemain->alamat}}</textarea>
    
                </div>

                <div class="form-group mt-2">
                    <label>No. Telepon:</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text" >+62</span>
                        <input  type="number" class="form-control" placeholder="example" 
                        name="no_telp"  value="{{$user->pemain->no_telp}}" required/>
                      </div>
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
                    <textarea name="deskripsi_pemain" id="" required placeholder="deskripsi diri anda"
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

{{-- EDIT PROFIL PEMAIN --}}
{{-- <div class="modal fade" id="editProfil-modal-{{$user->pemain->nisn_pemain}}" tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Pemain</h1>
        </div>
        <div class="modal-body">
            <form id="edit-pl-form-{{$user->pemain->nisn_pemain}}">
                <div class="form-group">
                    <label>Nama Pemain</label>
                    <input placeholder="example" type="text" class="form-control mb-3"
                            name="nama_pemain"
                            value="{{$user->pemain->nama_pemain}}"
                            required/>
                    @csrf
                </div>
                
                <div class="form-group">
                <label>Alamat:</label>
                    <textarea required name="alamat" id="" class="form-control" rows="3" 
                        placeholder="Deskripsi Diri" style="resize: none">{{$user->pemain->alamat}}
                    </textarea>
                </div>

                <div class="form-group mt-2">
                    <label>No. Telepon:</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text" >+62</span>
                        <input  type="number" class="form-control" placeholder="example" "
                        name="no_telp"  value="{{$user->pemain->no_telp}}" required/>
                      </div>
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
                        form="edit-pm-form-{{$user->pemain->nisn_pemain}}">
                    Edit
                </button>
            </div>
        </div>
    </div>
</div>
</div> --}}

 {{-- EDIT USERNAME--}}
 <div class="modal fade" id="editUsername-modal-{{$user->id_user}}" tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Username Pemain</h1>
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
</div>

    {{--- EDIT FOTO PROFIL --}}
<div class="modal fade" id="editFotoProfil-modal-{{$user->id_user}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ganti Foto Profil</h1>
            </div>
            <form id="edit-fp-form-{{$user->id_user}}" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="col-md-4 mt-0 align-items-center">
                        <label for="fileUpload">Upload Gambar</label>
                        <input type="file" name="foto_profil" id="fileUpload" onchange="previewImage()"
                            class="btn w-auto btn-outline-primary form-control">
                        
                        <img src="#" id="imagePreview" alt="preview" 
                        style="width: 250px; height: 250px; display: none" 
                        class="mt-2 rounded ">
                        @csrf
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary edit-btn" form="edit-fp-form-{{$user->id_user}}">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                        swal.fire('Selamat!', 'Pemain berhasil diedit.', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Pemain gagal diedit!', 'Pastikan mengisi data seluruhnya.', 'warning');
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
                        swal.fire('Berhasil edit username!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Gagal edit username!', '', 'warning');
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
                        swal.fire('Berhasil ganti password!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Gagal ganti password!', '', 'warning');
                    })
            })
        })

         // pop up foto profil
         $('.editBtn').on('click', function (e) {
            e.preventDefault();
            let idUser = $(this).attr('idUser');
            $(`#edit-fp-form-${idUser}`).on('submit', function (e) {
                e.preventDefault();
                let data = Object.fromEntries(new FormData(e.target));
                data['id_user'] = idUser;
                axios.post(`/profil/edit/foto_profil/${idUser}`, data, {
                    headers: {'Content-Type': 'multipart/form-data'}
                })
                    .then(() => {
                        $(`#editFotoProfil-modal-${idUser}`).css('display', 'none')
                        swal.fire('Berhasil edit foto profil!', '', 'success').then(function () {
                            location.reload();
                        })
                    })
                    .catch(() => {
                        swal.fire('Gagal edit foto profil!', '', 'warning');
                    })
            })
        })
    </script>
@endsection