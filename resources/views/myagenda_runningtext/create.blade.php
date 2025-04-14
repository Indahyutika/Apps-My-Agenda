@extends('template')
@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan saat mengisi formulir:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('myagenda_runningtext.store') }}">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Tambah Data Berita</h5>
                        <div class="card-body demo-vertical-spacing demo-only-element">

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="myagenda_runningtext_tgl_mulai" class="form-label">Tanggal</label>
                                    <div class="input-group">
                                        <input type="date" name="myagenda_runningtext_tgl_mulai" id="tgl_mulai" class="form-control" value="{{ now()->toDateString() }}" min="{{ now()->toDateString() }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="myagenda_runningtext_tgl_akhir" class="form-label">Tanggal Akhir</label>
                                    <div class="input-group">
                                        <input type="date" name="myagenda_runningtext_tgl_akhir" id="tgl_mulai" class="form-control" value="{{ now()->toDateString() }}" min="{{ now()->toDateString() }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="myagenda_runningtext_judul" class="form-label">Judul</label>
                                    <div class="input-group">
                                        <input type="text" name="myagenda_runningtext_judul" id="judul" class="form-control" placeholder="Judul">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="myagenda_runningtext_konten" class="form-label">Konten</label>
                                    <div class="input-group">
                                        <input type="text" name="myagenda_runningtext_konten" id="konten" class="form-control" placeholder="Konten" required>
                                    </div>
                                </div>
                            </div>


                            <div class="mt-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <button type="reset" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('myagenda_runningtext.index') }}'">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @endsection
    <!--  value="{{ Auth::user()->myagenda_user_nama }}" -->