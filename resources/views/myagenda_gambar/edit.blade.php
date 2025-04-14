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
            <form method="POST" action="{{ route('myagenda_gambar.update', $gambars->myagenda_gambar_id) }}" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Tambah Data Berita</h5>
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="myagenda_gambar_tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="myagenda_gambar_tanggal" id="myagenda_gambar_tanggal" class="form-control" value="{{ $gambars->myagenda_gambar_tanggal }}" required>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row align-items-center">
                                    <!-- Kolom untuk Media -->
                                    <div class="col-md-3 d-flex align-items-start align-items-sm-center gap-4">
                                        <div style="position: relative; width: 100px; height: 100px;">
                                            @if ($gambars->myagenda_gambar_media)
                                            @php
                                            $filePath = 'storage/' . $gambars->myagenda_gambar_media;
                                            $fileExtension = pathinfo(public_path($filePath), PATHINFO_EXTENSION);
                                            @endphp

                                            @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                            <img src="{{ asset($filePath) }}" alt="media" class="d-block rounded" height="100" width="100" id="logoPreview" style="object-fit: cover;">
                                            @elseif(in_array($fileExtension, ['mp4', 'mov', 'avi']))
                                            <video width="200%" style="border-radius: 10px;" controls>
                                                <source src="{{ asset($filePath) }}" type="video/{{ $fileExtension }}">
                                                browser kamu gak support video tag sayangkuu~
                                            </video>
                                            @else
                                            <p class="logoPlaceholderText" id="logoPlaceholderText" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: gray; text-align: center;">File tidak bisa ditampilkan</p>
                                            @endif

                                            @else
                                            <span class="text-muted text-center d-block" id="logoPlaceholderText" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: gray; text-align: center;">Media belum tersedia.</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3 d-flex flex-column align-items-start">
                                        <div class="button-wrapper">
                                            <label for="logoUpload" class="btn btn-primary mb-2 w-100" tabindex="0">
                                                <span class="d-none d-sm-block text-center">Upload Media</span>
                                                <i class="bx bx-upload d-block d-sm-none"></i>
                                                <input type="file" class="account-file-input" id="logoUpload" hidden accept="image/png, image/jpeg, video/*" name="myagenda_gambar_media" onchange="previewLogo(this)">
                                            </label>
                                            <button type="button" class="btn btn-outline-secondary account-image-reset w-100" onclick="clearLogo()">
                                                <i class="bx bx-reset d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block text-center">Reset</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="myagenda_gambar_deskripsi" id="myagenda_gambar_deskripsi" class="form-control" required>{{ $gambars->myagenda_gambar_deskripsi }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary me-2">Simpan</button>
                        <button type="reset" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('myagenda_gambar.index') }}'">Kembali</button>
                    </div>

                </div>
        </div>
    </div>
    </form>
</div>
</div>
</div>

<script>
    function previewLogo(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById("logoPreview");
                const text = document.getElementById("logoPlaceholderText");

                img.src = e.target.result; 
                img.style.display = "block"; 
                text.style.display = "none"; 
            };
            reader.readAsDataURL(file);
        }
    }

    function clearLogo() {
    const previewContainer = document.getElementById("logoPreview");
    const placeholderText = document.getElementById("logoPlaceholderText");
    const input = document.getElementById("logoUpload");

    if (previewContainer) {
        previewContainer.src = ""; 
        previewContainer.style.display = "none"; 
    }

    const videoContainer = document.querySelector("video");
    if (videoContainer) {
        videoContainer.remove(); 
    }

    placeholderText.style.display = "block"; 
    input.value = ""; 
}

</script>
@endsection