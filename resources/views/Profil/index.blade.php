@extends('layouts.layout')
@section('title', $user->username)

@section('content')

@if (Auth::user()['role']=='pemain' )

    @include('Profil.pemain')

@elseif(Auth::user()['role']=='pelatih')

@yield('pelatih')
   
    @include('Profil.pelatih')

@else
    
{{-- @yield('name') --}}

@endif

@endsection