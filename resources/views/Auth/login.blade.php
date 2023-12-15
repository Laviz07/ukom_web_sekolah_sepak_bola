<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link href="@import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap');" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="{{ asset('/images/logo.png') }}">

    <style>
        .bg-image-vertical {
            position: relative;
            overflow: hidden;
            background-repeat: no-repeat;
            background-position: right center;
            background-size: auto 100%;
            }

        @media (min-width: 1025px) {
        .h-custom-2 {
        height: 100%;
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="bg-white">
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">
        
                <div class="px-5 ms-xl-5">
                    <div class="d-flex"><i class="fas fa-crow fa-2x me-9 pt-5 mt-xl-4" style="color: #709085;"></i>
                    <img src="{{asset('images/logo1.png')}}" alt="ssb logo" width="150" height="150" style="margin: 15px">
                    <h3 class="display-8 fw-bold ls-tight h3 text-uppercase" style="color: #003459; font-size:38px; margin-top: 45px">
                        <i>ONE</i><br>SOCCER
                    </h3></div>
                    
                </div>
        
                <div class="d-flex align-items-center h-custom-1 px-5 ms-xl-4  pt-xl-0 mt-xl-n5">
        
                    <form style="width: 32rem;" action="">
        
                    <h2 class="fw-bold mb-3 pb-1.5 h2 text-uppercase" style="color: #003459">Login</h2>
        
                    <div class="form-outline mb-2">
                        <label class="form-label" for="username" style="font-size: 16px">Username</label>
                        <input type="text" id="username" name="username" placeholder="Masukkan Username" class="form-control form-control-lg" />
                        
                    </div>
        
                    <div class="form-outline mb-2" style="position: relative;">
                        <label class="form-label" for="password" style="font-size: 16px">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan Password" class="form-control form-control-lg" style="width: 100%; padding-right: 30px;">
                        <input type="checkbox" onclick="myFunction()" style="margin-top: 10px"> Show Password
                    </div>
                    <script>
                        function myFunction() {
                            var x = document.getElementById("password");
                            if (x.type === "password") {
                                x.type = "text";
                            } else {
                                x.type = "password";
                            }
                            }
                    </script>

                    <div class="pt-1 mb-4">
                        <button class="btn btn-info btn-lg btn-block" type="submit"  style="background-color: #003459; color:aliceblue; width:100%">Login</button>
                    </div>
                    @csrf
                    </form>
        
                </div>
        
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="{{asset('images/bg_ssb.png')}}" alt="bg logo"
                    alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>

<script type="module">
    $('form').submit(async function (e) {
        e.preventDefault();
        let username = $('#username').val();
        let password = $('#password').val();

        try {
            const response = await axios.post('/login', {
                username,
                password
            }).then((res) => {
            console.log(res);                
            const role = res.data.role;

            if (role === 'admin') {
                swal.fire({
                    title: 'Login berhasil!',
                    text: 'Redirecting to dashboard...',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false
                }).then(() => {
                    window.location = '/dashboard';
                });
            } else {
                swal.fire({
                    title: 'Login berhasil!',
                    text: 'Redirecting to beranda...',
                    icon: 'success',
                    timer: 1000,
                    showConfirmButton: false
                }).then(() => {
                    window.location = '/beranda';
                });
            }
            })


            console.log(response);
        } catch (error) {
            swal.fire('Waduh!', 'Anda tidak bisa login, pastikan username dan password terisi dengan benar!', 'warning');
            console.error(error);
        }
    });
</script>


</body>

</html>

