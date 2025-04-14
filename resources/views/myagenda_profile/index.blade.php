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
</style>

<div class="container">
    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('myagenda_profile.create') }}" class="btn btn-outline-primary">
            <i class="bx bx-plus"></i>&nbsp; Tambah
        </a>
    </div>

    <form action="{{ route('myagenda_profile.index') }}" method="GET">
        <div class="card">
            <h5 class="card-header">PROFILE</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="myagenda_profile" class="table table-bordered table-striped">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            @foreach ($profile as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $p->myagenda_profile_foto) }}" alt="logo" style="width: 80px;">
                                </td>
                                <td>{{ $p->myagenda_profile_nama }}</td>
                                <td>
                                    <a href="{{ route('myagenda_profile.edit', $p->myagenda_profile_id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bx bx-edit-alt me-1"></i>
                                    </a>
                                    <form action="{{ route('myagenda_profile.destroy', $p->myagenda_profile_id) }}" method="POST" class="d-inline form-hapus">
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
        $('#myagenda_profile').DataTable({
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
        $('#myagenda_profile').on('click', '.btn-hapus', function (e) {
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
