@extends('template')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Kolom besar (col-10) -->
        <div class="col-lg-10 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat datang di Dashboard, Admin! 🚀</h5>
                            <p class="mb-4">
                                Pantau semua aktivitas dan perkembangan terbaru di sini. Pastikan semuanya berjalan dengan lancar dan tetap produktif!
                            </p>


                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img
                                src="{{ asset('dashboard/assets/img/illustrations/man-with-laptop-light.png') }}"
                                height="160"
                                alt="View Badge User"
                                data-app-dark-img="{{ asset('dashboard/assets/img/illustrations/man-with-laptop-dark.png') }}"
                                data-app-light-img="{{ asset('dashboard/assets/img/illustrations/man-with-laptop-light.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom kecil (col-2) untuk profit -->
        <div class="col-lg-2 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0 me-auto">
                                    <i class="bx bx-user bx-md text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button
                                        class="btn p-0"
                                        type="button"
                                        id="cardOpt3"
                                        data-bs-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                    </button>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Pengguna</span>
                            <h3 class="card-title mb-2">{{ $jumlahPengguna }}</h3>
                            <small class="{{ $persentasePertumbuhan >= 0 ? 'text-success' : 'text-danger' }} fw-semibold">
                                <i class="bx {{ $persentasePertumbuhan >= 0 ? 'bx-up-arrow-alt' : 'bx-down-arrow-alt' }}"></i>
                                {{ $persentasePertumbuhan }}%
                            </small>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        margin: 3px;
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid #d9dee3;
        border-radius: 0.5rem;
    }

    /* Paksa tabel lebih naik */
    .table-container {
        position: relative;
        top: -140px;
        /* Bisa disesuaikan */
    }

    .table-responsive {
        border-radius: 0.5rem;
        overflow-x: auto;
        /* Supaya bisa geser ke samping */
        white-space: nowrap;
        /* Biar tabel gak turun ke bawah */
    }
</style>


<div class="container table-container"> <!-- Tambahin class table-container -->
    <form action="{{ route('myagenda_sekolah.index') }}" method="GET">
        <div class="card">
            <h5 class="card-header">SEKOLAH TERDAFTAR</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>Logo</th>
                                <th>Nama Sekolah</th>
                                <th>Email Sekolah</th>
                                <th>Akreditasi</th>
                                <th>No. Tlp</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            @foreach ($sekolah as $sekolah)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img src="{{ asset('storage/'. $sekolah->myagenda_sekolah_logo) }}" alt="logo" style="width: 80px;">
                                </td>
                                <td>{{$sekolah->myagenda_sekolah_nama}}</td>
                                <td>{{$sekolah->myagenda_sekolah_email}}</td>
                                <td>{{$sekolah->myagenda_sekolah_akreditasi}}</td>
                                <td>{{$sekolah->myagenda_sekolah_tlp}}</td>
                                <td>{{$sekolah->myagenda_sekolah_alamat}}</td>
                                <td>
                                    <form action="{{ route('myagenda_sekolah.destroy', $sekolah->myagenda_sekolah_id) }}" method="POST" class="d-inline">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bx bx-trash me-1"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection