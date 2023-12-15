<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link rel="icon" href="{{ asset('/images/logo.png') }}">

    @vite(['resources/sass/app.scss','resources/js/app.js'])
    <title>@yield('title')</title>
    @yield('header')

    <style>
    a{
        font-size:14px;
        
        font-weight:700;
    }
    .superNav {
      font-size:13px;
    }

    .navbar-nav a{
        color: white;
    }
    .form-control {
      outline:none !important;
      box-shadow: none !important;
    }
    @media screen and (max-width:540px){
      .centerOnMobile {
        text-align:center
      }
    }
    </style>

</head>

<body>
   <div class="superNav border-bottom py-2 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 centerOnMobile">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="80px">
            <span class="h4" style="color: #003459;"><strong><i>ONE </i>SOCCER</strong></span>
        </div>
        
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 d-none d-lg-block d-md-block-d-sm-block d-xs-none  text-end">
          
          @if (!Auth::check())
               <a href="{{ url('login', []) }}" class="btn btn-success btn-lg mt-2" >Login</a>
          @endif
         
          @if (Auth::check())
               <div class="dropdown" style="display: inline-block; vertical-align: middle;">
                <i  class="bi bi-person-circle" 
                    id="navbarDropdownMenuLink" data-bs-toggle='dropdown'
                    style="font-size: 40px; vertical-align: middle; cursor: pointer;">
                </i>
                <div class="dropdown-menu" style="width: 200px;" aria-labelledby="navbarDropdownMenuLink">
                    <div class="col">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-circle ms-3" style="font-size: 40px; vertical-align: middle;"></i>
                            <img src="" alt="">
                            <div class="ms-0 row">
                                <span class="text-capitalize"><strong> {{Auth::user()->username}} </strong></span>
                                <span style="" class="text-capitalize">{{Auth::user()->role}}</span>
                            </div>
                        </div>
                    </div>
                <hr style="margin-top: -1px">

                @if (Auth::user()->role != 'admin')
                <a class="dropdown-item" href="{{ url('profil', ['']) }}"> 
                  <i class="bi bi-person-circle"  style="font-size: 20px; vertical-align: middle; "></i> 
                  <strong class="ms-1">Profil Anda</strong> 
                </a>
                @endif

                   <a class="dropdown-item" href="{{ url('logout', []) }}"> 
                    <i class="bi bi-box-arrow-right"  style="font-size: 20px; vertical-align: middle; color: #DC3545;"></i> 
                    <strong class="ms-1" style="color: #DC3545;">Log Out</strong> 
                   </a>
                  </div>
                </div>
            </div>
          @endif
           

      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg p-2 shadow-sm" style="background-color:#007EA7;">
    <div class="container">
    
        <ul class="navbar-nav" >
          @if (Auth::check() && Auth::user()->role == 'admin')
          <li class="nav-item ">
            <a class="nav-link mx-2 text-uppercase" aria-current="page" href="{{ url('dashboard', []) }}">Dashboard</a>
          </li>
          @endif
          {{-- @if (Auth::check() && Auth::user()->role != 'admin') --}}
          <li class="nav-item ">
            <a class="nav-link mx-2 text-uppercase" aria-current="page" href="{{ url('', []) }}">Beranda</a>
          </li>
          {{-- @endif --}}
          <li class="nav-item">
            <a class="nav-link mx-2 text-uppercase" href="{{ url('berita', []) }}">Berita</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-2 text-uppercase" href="{{ url('galeri', []) }}">Galeri</a>
          </li>
          @if (Auth::check() && Auth::user()->role == 'admin')
          <li class="nav-item ">
            <a class="nav-link mx-2 text-uppercase" aria-current="page" href="{{ url('admin', []) }}">Admin</a>
          </li>
          @endif
          @if (Auth::check())
            <li class="nav-item">
              <a class="nav-link mx-2 text-uppercase" href="{{ url('pelatih', []) }}">Pelatih</a>
            </li>

            <li class="nav-item">
              <a class="nav-link mx-2 text-uppercase" href="{{ url('pemain', []) }}">Pemain</a>
            </li>

            <li class="nav-item">
              <a class="nav-link mx-2 text-uppercase" href="{{ url('tim', []) }}">Tim</a>
            </li>

            <li class="nav-item">
              <a class="nav-link mx-2 text-uppercase" href="{{ url('jadwal', []) }}">Jadwal</a>
            </li>

            @if (Auth::user()['role']=='admin')
              <li class="nav-item">
                <a class="nav-link mx-2 text-uppercase" href="{{ url('log', []) }}">Aktifitas</a>
              </li>
            @endif
          @endif

          
         

        </ul>
        
      </div>
    </div>
  </nav>

  <div class="container">
    @include('layouts.flashMessage')
    @yield('content')
  </div>


</body>

<footer>
    @yield('footer')
</footer>

</html>