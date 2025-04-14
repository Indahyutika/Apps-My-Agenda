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
    <!-- Content -->
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
        <div class="text-center w-100">
            <h2 class="mb-3 fw-bold">Data Sekolah Belum Tersedia</h2>
            <p class="mb-4 fs-5">Oops! 😖 Kami tidak menemukan data sekolah yang terdaftar.</p>
            <a href="{{ route('myagenda_sekolah.create') }}" class="btn btn-lg btn-primary">Silakan lengkapi data sekolah</a>
            <div class="mt-4">
                <img
                    src="{{ asset('dashboard/assets/img/illustrations/dashboard-sekolah.png') }}"
                    alt="Data Sekolah Kosong"
                    class="img-fluid"
                    style="max-width: 600px;" />
            </div>
        </div>
    </div>
</body>

</html>
@endsection