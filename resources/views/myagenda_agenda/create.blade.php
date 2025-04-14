@extends('template')
@section('content')
<div class="content-wrapper">
    <script>
        function addDetailRow() {
            let detailContainer = document.getElementById('agenda-details');
            let index = detailContainer.children.length;
            let row = document.createElement('div');
            row.classList.add('detail-row', 'mb-3', 'border', 'p-3', 'rounded');
            row.innerHTML = `
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="tgl_awal_${index}" class="form-label">Tanggal Awal</label>
                    <input type="date" class="form-control" id="tgl_awal_${index}" name="details[${index}][myagenda_agendadetail_tgl_awal]" value="{{ now()->toDateString() }}" min="{{ now()->toDateString() }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tgl_akhir_${index}" class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tgl_akhir_${index}" name="details[${index}][myagenda_agendadetail_tgl_akhir]" value="{{ now()->toDateString() }}" min="{{ now()->toDateString() }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="jumlah_hari_${index}" class="form-label">Jumlah Hari</label>
                    <input type="number" class="form-control" id="jumlah_hari_${index}" name="details[${index}][myagenda_agendadetail_jumlah_hari]" min="1" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="pic_${index}" class="form-label">PIC</label>
                    <input type="text" class="form-control" id="pic_${index}" name="details[${index}][myagenda_agendadetail_pic]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email_pic_${index}" class="form-label">Email PIC</label>
                    <input type="email" class="form-control" id="email_pic_${index}" name="details[${index}][myagenda_agendadetail_email_pic]" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kegiatan_${index}" class="form-label">Kegiatan</label>
                    <input type="text" class="form-control" id="kegiatan_${index}" name="details[${index}][myagenda_agendadetail_kegiatan]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="deskripsi_${index}" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi_${index}" name="details[${index}][myagenda_agendadetail_deskripsi]" required></textarea>
                </div>
            </div>
            <button type="button" class="btn btn-danger" onclick="removeDetailRow(this)">Hapus</button>
            `;
            detailContainer.appendChild(row);
        }

        function removeDetailRow(button) {
            button.closest('.detail-row').remove();
        }
    </script>
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
            <form method="POST" action="{{ route('myagenda_agenda.store') }}">
                @csrf
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Tambah Data Berita</h5>
                        <div class="card-body demo-vertical-spacing demo-only-element">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="myagenda_agenda_judul" class="form-label">Judul</label>
                                    <div class="input-group">
                                        <input type="text" name="myagenda_agenda_judul" id="myagenda_agenda_judul" class="form-control" placeholder="Judul" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="myagenda_agenda_tanggal" class="form-label">Tanggal</label>
                                    <div class="input-group">
                                        <input type="date" name="myagenda_agenda_tanggal" id="myagenda_agenda_tanggal" class="form-control" value="{{ now()->toDateString() }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <h4>Detail Agenda</h4>
                            <div id="agenda-details" class="mb-3"></div>
                            <button type="button" class="btn btn-info mb-3" onclick="addDetailRow()">Tambah Detail</button>
                            <div class="mt-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('myagenda_agenda.index') }}'">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection