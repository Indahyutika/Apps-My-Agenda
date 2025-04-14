@extends('template')
@section('content')

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
        margin-top: 20px;
    }

    .card-body {
        padding: 20px;
    }

    #myagenda_gambar {
        margin-bottom: 20px;
    }

    .btn-outline-primary {
        margin-bottom: 10px;
    }

    #myagenda_gambar thead th {
        text-align: center !important;
        vertical-align: middle !important;
    }

    #myagenda_gambar tbody td {
        text-align: center;
        vertical-align: middle;
    }

    #myagenda_gambar tbody tr {
        border-bottom: 1px solid #dee2e6;
    }

    #myagenda_gambar th,
    #myagenda_gambar td {
        border: 1px solid #dee2e6 !important;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('myagenda_gambar.create') }}" class="btn btn-outline-primary">
            <i class="bx bx-plus"></i>&nbsp; Tambah
        </a>
    </div>

    <form action="{{ route('myagenda_gambar.index') }}" method="GET">
        <div class="card">
            <h5 class="card-header">MEDIA</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="myagenda_gambar" class="table table-bordered table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Media</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            @foreach ($gambars as $gambar)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $gambar->myagenda_gambar_tanggal }}</td>
                                <td>
                                    @php
                                        $filePath = 'storage/' . $gambar->myagenda_gambar_media;
                                        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                                    @endphp

                                    @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ asset($filePath) }}" alt="media" style="width: 80px;">
                                    @elseif(in_array($fileExtension, ['mp4', 'mov', 'avi']))
                                        <video width="150" controls>
                                            <source src="{{ asset($filePath) }}" type="video/{{ $fileExtension }}">
                                            browser kamu gak support video tag sayangkuu~
                                        </video>
                                    @else
                                        <p>file tidak bisa ditampilkan</p>
                                    @endif
                                </td>
                                <td>{{ $gambar->myagenda_gambar_deskripsi }}</td>
                                <td>
                                    <a href="{{ route('myagenda_gambar.edit', $gambar->myagenda_gambar_id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bx bx-edit-alt me-1"></i>
                                    </a>
                                    <form action="{{ route('myagenda_gambar.destroy', $gambar->myagenda_gambar_id) }}" method="POST" class="d-inline form-hapus">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger btn-hapus">
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

@push('scripts')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- Inisialisasi DataTables -->
<script>
    $(document).ready(function () {
        $('#myagenda_gambar').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });
    });
</script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Notifikasi Berhasil -->
<script>
    $(document).ready(function () {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    });
</script>

<!-- Konfirmasi Hapus -->
<script>
    $(document).ready(function () {
        $('#myagenda_gambar').on('click', '.btn-hapus', function (e) {
            e.preventDefault();
            let form = $(this).closest('form');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
