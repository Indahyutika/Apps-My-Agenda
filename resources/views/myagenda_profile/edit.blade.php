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
            <form method="POST" action="{{ route('myagenda_profile.update', $profile->myagenda_profile_id) }}" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}

                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Profile</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="row">
                                <!-- Preview Foto & Nama -->
                                <div class="col-md-6 text-center">
                                    <div style="position: relative; width: 120px; height: 120px; margin: auto;">
                                        <img id="logoPreview" 
                                            src="{{ $profile->myagenda_profile_foto ? asset('storage/' . $profile->myagenda_profile_foto) : 'https://via.placeholder.com/120' }}" 
                                            class="d-block rounded-circle" 
                                            height="120" width="120" 
                                            style="object-fit: cover;" />
                                    </div>
                                    <label for="myagenda_profile_nama" class="form-label mt-3"></label>
                                    <input type="text" class="form-control text-center" id="myagenda_profile_nama" 
                                           name="myagenda_profile_nama" 
                                           value="{{ $profile->myagenda_profile_nama }}" required>
                                </div>

                                <!-- Tombol Upload & Reset -->
                                <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                                    <label for="logoUpload" class="btn btn-primary mb-2" tabindex="0">
                                        <span>Upload New Profile</span>
                                        <input type="file" class="account-file-input" id="logoUpload" 
                                               name="myagenda_profile_foto" hidden accept="image/png, image/jpeg" 
                                               onchange="previewLogo(this)">
                                    </label>
                                    <button type="button" class="btn btn-outline-secondary" onclick="clearLogo()">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Simpan & Kembali -->
                    <div class="mt-2 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary" 
                                onclick="window.location.href='{{ route('myagenda_profile.index') }}'">
                            Kembali
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to preview image saat pilih file
    function previewLogo(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("logoPreview").src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Fungsi untuk reset foto
    function clearLogo() {
        document.getElementById("logoPreview").src = "https://via.placeholder.com/120";
        document.getElementById("logoUpload").value = "";
    }
</script>

@endsection
