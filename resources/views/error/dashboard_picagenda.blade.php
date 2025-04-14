@extends('template')
@section('content')
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
    lang="en"
    class="light-style"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<body>
   <br>
   <br>
   <br>
    <!-- Content -->
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100 py-5">
        <div class="text-center w-75">
            @if ($mediaExists && !$agendaExists)
            <h2 class="mb-3 fw-bold">Agenda kamu masih kosong nih!</h2>
            <p class="mb-4 fs-5">Yuk, lengkapi agendamu sekarang biar makin terorganisir!</p>
            <a href="{{ route('myagenda_agenda.create') }}" class="btn btn-info">Buat Agenda Sekarang!</a>
            @elseif (!$mediaExists && $agendaExists)
            <h2 class="mb-3 fw-bold">Kamu belum punya media pendukung!</h2>
            <p class="mb-4 fs-5">Ayo tambahkan media biar agendamu lebih menarik!</p>
            <a href="{{ route('myagenda_gambar.create') }}" class="btn btn-primary">Buat Media Sekarang!</a>
            @elseif (!$mediaExists && !$agendaExists)
            <h2 class="mb-3 fw-bold">Oops! Aku belum menemukan media dan agenda kamu nih.</h2>
            <p class="mb-4 fs-5">Yuk, mulai buat media dan agendamu sekarang biar makin keren!</p>
            <a href="{{ route('myagenda_gambar.create') }}" class="btn btn-primary">Buat Media Sekarang!</a>
            <a href="{{ route('myagenda_agenda.create') }}" class="btn btn-info">Buat Agenda Sekarang!</a>
            @endif
            <div class="mt-4">
                <img
                    src="{{ asset('dashboard/assets/img/illustrations/dashboard-sekolah-2.png') }}"
                    alt="Data Sekolah Kosong"
                    class="img-fluid"
                    style="max-width: 500px;" />
            </div>
        </div>
    </div>


</body>

</html>
@endsection