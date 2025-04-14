@extends('template')
@section('content')
<div class="content-wrapper">
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
            <form action="{{ route('myagenda_gambar.store') }}" method="POST" id="uploadForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Tambah Data Berita</h5>
                        <div class="card-body">

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="myagenda_gambar_tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="myagenda_gambar_tanggal" id="myagenda_gambar_tanggal" class="form-control" value="{{ now()->toDateString() }}" readonly>
                                </div>
                            </div>

                            <!-- Table untuk Media -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th style="width: 15%;">Media</th>
                                            <th style="width: 20%;">Upload</th>
                                            <th style="width: 55%;">Deskripsi</th>
                                            <th style="width: 10%;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="mediaContainer">
                                        <tr class="media-item">
                                            <td class="text-center">
                                                <div style="position: relative; width: 100px; height: 100px;">
                                                    <img src="https://via.placeholder.com/100" class="d-block rounded" height="100" width="100" id="logoPreview" style="display: none; object-fit: cover;">
                                                    <span id="logoPlaceholderText" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: gray; text-align: center;">
                                                        Media belum tersedia.
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <label for="logoUpload" class="btn btn-primary mb-2 w-100">
                                                        <span class="d-none d-sm-block text-center">Upload</span>
                                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                                        <input type="file" class="account-file-input" id="logoUpload" hidden accept="image/png, image/jpeg, video/*" name="myagenda_gambar_media[]" required>
                                                    </label>
                                                    <button type="button" class="btn btn-outline-secondary w-100" onclick="clearLogo()">
                                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block text-center">Reset</span>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <textarea name="myagenda_gambar_deskripsi[]" class="form-control" required></textarea>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger removeRow">Hapus</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Button Tambah -->
                            <div class="text-start mt-3">
                                <button type="button" class="btn btn-info" id="addRow">Tambah Media</button>
                            </div>

                            <!-- Button Simpan & Kembali -->
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
    document.getElementById('addRow').addEventListener('click', function() {
        let mediaContainer = document.getElementById('mediaContainer');
        let uniqueId = Date.now(); // bikin ID unik biar tiap elemen beda
        let newRow = document.createElement('tr');
        newRow.classList.add('media-item');

        newRow.innerHTML = `
            <td class="text-center">
                <div style="position: relative; width: 100px; height: 100px;">
                    <img src="https://via.placeholder.com/100" class="d-block rounded preview-img" id="preview-img-${uniqueId}" height="100" width="100" style="display: none; object-fit: cover;">
                    <video id="preview-video-${uniqueId}" height="100" width="100" style="display: none; object-fit: cover;" controls></video>
                    <span class="placeholder-text" id="placeholder-${uniqueId}" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: gray; text-align: center;">
                        Media belum tersedia.
                    </span>
                </div>
            </td>
            <td>
                <div class="d-flex flex-column">
                    <label class="btn btn-primary mb-2 w-100">
                        <span class="d-none d-sm-block text-center">Upload</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input type="file" class="account-file-input file-input" id="upload-${uniqueId}" hidden accept="image/png, image/jpeg, video/*" name="myagenda_gambar_media[]" required>
                    </label>
                    <button type="button" class="btn btn-outline-secondary w-100 reset-btn" data-preview-img="preview-img-${uniqueId}" data-preview-video="preview-video-${uniqueId}" data-placeholder="placeholder-${uniqueId}" data-input="upload-${uniqueId}">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block text-center">Reset</span>
                    </button>
                </div>
            </td>
            <td>
                <textarea name="myagenda_gambar_deskripsi[]" class="form-control" required></textarea>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger removeRow">Hapus</button>
            </td>
        `;
        mediaContainer.appendChild(newRow);

        // Tambahin event listener buat input file yang baru
        let newFileInput = document.getElementById(`upload-${uniqueId}`);
        newFileInput.addEventListener('change', function() {
            previewMedia(this, `preview-img-${uniqueId}`, `preview-video-${uniqueId}`, `placeholder-${uniqueId}`);
        });
    });

    function previewMedia(input, previewImgId, previewVideoId, placeholderId) {
        let file = input.files[0];
        if (file) {
            let reader = new FileReader();
            let img = document.getElementById(previewImgId);
            let video = document.getElementById(previewVideoId);
            let text = document.getElementById(placeholderId);

            reader.onload = function(e) {
                if (file.type.startsWith('image')) {
                    img.src = e.target.result;
                    img.style.display = "block";
                    video.style.display = "none";
                } else if (file.type.startsWith('video')) {
                    video.src = e.target.result;
                    video.style.display = "block";
                    img.style.display = "none";
                }
                text.style.display = "none";
            };
            reader.readAsDataURL(file);
        }
    }

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('reset-btn')) {
            let img = document.getElementById(event.target.dataset.previewImg);
            let video = document.getElementById(event.target.dataset.previewVideo);
            let text = document.getElementById(event.target.dataset.placeholder);
            let input = document.getElementById(event.target.dataset.input);

            img.src = "";
            img.style.display = "none";
            video.src = "";
            video.style.display = "none";
            text.style.display = "block";
            input.value = "";
        }

        if (event.target.classList.contains('removeRow')) {
            event.target.closest('tr').remove();
        }
    });

    // Biar yang pertama kali udah ada juga bisa ke-preview
    document.getElementById("logoUpload").addEventListener("change", function() {
        previewMedia(this, "logoPreview", "logoPreviewVideo", "logoPlaceholderText");
    });
    
  function clearLogo() {
    const img = document.getElementById("logoPreview");
    const text = document.getElementById("logoPlaceholderText");
    const input = document.getElementById("logoUpload");

    img.src = ""; // Clear the image
    img.style.display = "none"; // Hide the image
    text.style.display = "block"; // Show the placeholder text again
    input.value = ""; // Clear the file input to allow re-upload
  }

  // Add event listener for image upload
  document.getElementById("logoUpload").addEventListener("change", function() {
    previewLogo(this); // Call the previewLogo function on change
  });
</script>
@endsection
