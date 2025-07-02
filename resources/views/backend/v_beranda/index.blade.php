@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->

<h3> {{$judul}} </h3>
<p>
    Selamat Datang, <b>{{ Auth::user()->name }}</b> pada aplikasi Qurban Distribution dengan hak
    akses yang anda miliki sebagai
    <b>
        @if (Auth::user()->role == 1)
        Super Admin
        @elseif(Auth::user()->role == 'admin' || Auth::user()->role == 0)
        Admin
        @elseif(Auth::user()->role == 'user')
        User
        @elseif(Auth::user()->role == 'panitia')
        Panitia
        @else
        Role tidak dikenal
        @endif
    </b>
    ini adalah halaman utama dari aplikasi ini.
</p>

<!-- contentAkhir -->
@endsection