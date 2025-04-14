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

    #myagenda_runningtext {
        margin-bottom: 20px;
        margin-top: 15px;
        border-collapse: collapse !important;
    }

    .btn-outline-primary {
        margin-bottom: 10px;
    }

    #myagenda_runningtext th,
    #myagenda_runningtext td {
        text-align: center;
        vertical-align: middle;
        border: 1px solid #dee2e6 !important;
    }

    #myagenda_runningtext tr {
        border-bottom: 1px solid #dee2e6 !important;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('myagenda_sekolah.create') }}" class="btn btn-outline-primary">
            <i class="bx bx-plus"></i>&nbsp; Tambah
        </a>
    </div>

    <form action="{{ route('myagenda_sekolah.index') }}" method="GET">
        <div class="card">
            <h5 class="card-header">SEKOLAH</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="myagenda_runningtext" class="table table-bordered table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>Logo</th>
                                <th>Nama Sekolah</th>
                                <th>Email Sekolah</th>
                                <th>Akreditasi</th>
                                <th>No. Tlp</th>
                                <th>Provinsi</th>
                                <th>Kab/Kota</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Kode Pos</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            @foreach ($sekolahs as $sekolah)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset('storage/'. $sekolah->myagenda_sekolah_logo) }}" alt="logo" style="width: 80px;"></td>
                                <td>{{ $sekolah->myagenda_sekolah_nama }}</td>
                                <td>{{ $sekolah->myagenda_sekolah_email }}</td>
                                <td>{{ $sekolah->myagenda_sekolah_akreditasi }}</td>
                                <td>{{ $sekolah->myagenda_sekolah_tlp }}</td>
                                <td>{{ $sekolah->provinsi->name }}</td>
                                <td>{{ $sekolah->kabkota->name }}</td>
                                <td>{{ $sekolah->kec->name }}</td>
                                <td>{{ $sekolah->kel->name }}</td>
                                <td>{{ $sekolah->myagenda_sekolah_kodepos }}</td>
                                <td>{{ $sekolah->myagenda_sekolah_alamat }}</td>
                                <td>
                                    <a href="{{ route('myagenda_sekolah.edit', $sekolah->myagenda_sekolah_id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bx bx-edit-alt me-1"></i>
                                    </a>
                                    <form action="{{ route('myagenda_sekolah.destroy', $sekolah->myagenda_sekolah_id) }}" method="POST" class="d-inline">
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

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#myagenda_runningtext').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });

        // notifikasi berhasil
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        // konfirmasi hapus
        $('#myagenda_runningtext').on('click', '.btn-hapus', function (e) {
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
