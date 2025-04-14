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
            <form method="POST" action="{{ route('myagenda_sekolah.update', $sekolah->myagenda_sekolah_id) }}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Profile Details</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <div style="position: relative; width: 100px; height: 100px;">
                                    <!-- Jika logo ada, tampilkan gambar logo -->
                                    @if ($sekolah->myagenda_sekolah_logo)
                                    <img src="{{ asset('storage/' . $sekolah->myagenda_sekolah_logo) }}" class="d-block rounded" height="100" width="100" id="logoPreview" style="object-fit: cover;" />
                                    @else
                                    <!-- Kalau tidak ada logo, tampilkan teks placeholder -->
                                    <span id="logoPlaceholderText" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: gray; text-align: center;">
                                        Logo belum tersedia.
                                    </span>
                                    @endif
                                </div>

                                <div class="button-wrapper">
                                    <!-- Tombol untuk upload logo -->
                                    <label for="logoUpload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new logo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" class="account-file-input" id="logoUpload" hidden accept="image/png, image/jpeg" name="myagenda_sekolah_logo" onchange="previewLogo(this)">
                                    </label>
                                    <!-- Tombol reset untuk menghapus logo -->
                                    <button type="button" class="btn btn-outline-secondary account-image-reset mb-4" onclick="clearLogo()">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="myagenda_sekolah_nama" class="form-label">Nama Sekolah</label>
                                    <input type="text" class="form-control" id="myagenda_sekolah_nama" name="myagenda_sekolah_nama" value="{{ $sekolah->myagenda_sekolah_nama }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="myagenda_sekolah_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="myagenda_sekolah_email" name="myagenda_sekolah_email" value="{{ $sekolah->myagenda_sekolah_email }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="myagenda_sekolah_akreditasi" class="form-label">Akreditasi</label>
                                    <input type="text" class="form-control" id="myagenda_sekolah_akreditasi" name="myagenda_sekolah_akreditasi" value="{{ $sekolah->myagenda_sekolah_akreditasi }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="myagenda_sekolah_tlp" class="form-label">No. Tlp</label>
                                    <input type="number" class="form-control" id="myagenda_sekolah_tlp" name="myagenda_sekolah_tlp" value="{{ $sekolah->myagenda_sekolah_tlp }}" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="provinsi">Provinsi</label>
                                    <select class="form-control" id="provinsi" name="myagenda_sekolah_provinsi" onchange="resetFields('provinsi')">
                                        <option value="{{ $sekolah->myagenda_sekolah_provinsi }}" selected>{{ $sekolah->provinsi->name }}</option>
                                        <!-- Populate provinsi from database -->
                                        @foreach($provinsi as $prov)
                                        <option value="{{ $prov->id }}">{{ $prov->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="kabupaten">Kabupaten/Kota</label>
                                    <select class="form-control" name="myagenda_sekolah_kab_kota" id="kabupaten" onchange="resetFields('kabupaten')">
                                        <option value="{{ $sekolah->myagenda_sekolah_kab_kota }}" selected>{{ $sekolah->kabkota->name }}</option>
                                        <!-- Populate kabupaten/kota from database -->
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="kecamatan">Kecamatan</label>
                                    <select class="form-control" name="myagenda_sekolah_kec" id="kecamatan" onchange="resetFields('kecamatan')">
                                        <option value="{{ $sekolah->myagenda_sekolah_kec }}" selected>{{ $sekolah->kec->name }}</option>
                                        <!-- Populate kecamatan from database -->
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="kelurahan">Kelurahan</label>
                                    <select class="form-control" name="myagenda_sekolah_kel" id="kelurahan">
                                        <option value="{{ $sekolah->myagenda_sekolah_kel }}" selected>{{ $sekolah->kel->name }}</option>
                                        <!-- Populate kelurahan from database -->
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="myagenda_sekolah_kodepos" class="form-label">Kode Pos</label>
                                    <input type="number" class="form-control" id="myagenda_sekolah_kodepos" name="myagenda_sekolah_kodepos" value="{{ $sekolah->myagenda_sekolah_kodepos }}" required>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="myagenda_sekolah_alamat" class="form-label">Alamat</label>
                                    <textarea name="myagenda_sekolah_alamat" id="myagenda_sekolah_alamat" class="form-control" rows="3">{{ $sekolah->myagenda_sekolah_alamat }}</textarea>
                                </div>

                            </div>
                            <div class="mt-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <button type="reset" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('myagenda_sekolah.index') }}'">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to preview image
    // Function to preview the uploaded image
    function previewLogo(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById("logoPreview");
                const text = document.getElementById("logoPlaceholderText");

                img.src = e.target.result; // Update src image
                img.style.display = "block"; // Munculkan gambar
                text.style.display = "none"; // Sembunyikan teks placeholder
            };
            reader.readAsDataURL(file);
        }
    }

    // Fungsi untuk reset logo
    function clearLogo() {
        const img = document.getElementById("logoPreview");
        const text = document.getElementById("logoPlaceholderText");
        const input = document.getElementById("logoUpload");

        img.src = ""; // Kosongkan src gambar
        img.style.display = "none"; // Sembunyikan gambar
        text.style.display = "block"; // Tampilkan teks placeholder
        input.value = ""; // Hapus input file
    }


    $(document).ready(function() {
        $('#provinsi').change(function() {
            var provinsi_id = $(this).val();
            if (provinsi_id) {
                $.ajax({
                    url: '/kabupaten/' + provinsi_id,
                    type: 'GET',
                    success: function(data) {
                        $('#kabupaten').html('<option value="">--Pilih Kabupaten/Kota--</option>');
                        $.each(data, function(key, value) {
                            $('#kabupaten').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                        $('#kecamatan').html('<option value="">--Pilih Kecamatan--</option>').prop('disabled', true);
                        $('#kelurahan').html('<option value="">--Pilih Kelurahan--</option>').prop('disabled', true);
                    }
                });
            } else {
                $('#kabupaten').html('<option value="">--Pilih Kabupaten/Kota--</option>').prop('disabled', true);
                $('#kecamatan').html('<option value="">--Pilih Kecamatan--</option>').prop('disabled', true);
                $('#kelurahan').html('<option value="">--Pilih Kelurahan--</option>').prop('disabled', true);
            }
        });

        $('#kabupaten').change(function() {
            var kabupaten_id = $(this).val();
            if (kabupaten_id) {
                $.ajax({
                    url: '/kecamatan/' + kabupaten_id,
                    type: 'GET',
                    success: function(data) {
                        $('#kecamatan').html('<option value="">--Pilih Kecamatan--</option>').prop('disabled', false);
                        $.each(data, function(key, value) {
                            $('#kecamatan').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                        $('#kelurahan').html('<option value="">--Pilih Kelurahan--</option>').prop('disabled', true);
                    }
                });
            } else {
                $('#kecamatan').html('<option value="">--Pilih Kecamatan--</option>').prop('disabled', true);
                $('#kelurahan').html('<option value="">--Pilih Kelurahan--</option>').prop('disabled', true);
            }
        });

        $('#kecamatan').change(function() {
            var kecamatan_id = $(this).val();
            if (kecamatan_id) {
                $.ajax({
                    url: '/kelurahan/' + kecamatan_id,
                    type: 'GET',
                    success: function(data) {
                        $('#kelurahan').html('<option value="">--Pilih Kelurahan--</option>').prop('disabled', false);
                        $.each(data, function(key, value) {
                            $('#kelurahan').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#kelurahan').html('<option value="">--Pilih Kelurahan--</option>').prop('disabled', true);
            }
        });
    });
</script>

@endsection