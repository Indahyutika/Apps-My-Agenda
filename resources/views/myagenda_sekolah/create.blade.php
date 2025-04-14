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
      <form method="POST" action="{{ route('myagenda_sekolah.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-12">
          <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            <!-- Account -->
            <div class="card-body">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <div style="position: relative; width: 100px; height: 100px;">
                  <img
                    src="https://via.placeholder.com/100"
                    class="d-block rounded"
                    height="100"
                    width="100"
                    id="logoPreview"
                    style="display: none; object-fit: cover;" />
                  <span id="logoPlaceholderText" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: gray; text-align: center;">
                    Logo belum tersedia.
                  </span>
                </div>

                <div class="button-wrapper">
                  <label for="logoUpload" class="btn btn-primary me-2 mb-4" tabindex="0">
                    <span class="d-none d-sm-block">Upload new logo</span>
                    <i class="bx bx-upload d-block d-sm-none"></i>
                    <input type="file" class="account-file-input" id="logoUpload" name="myagenda_sekolah_logo" hidden accept="image/png, image/jpeg" required>
                  </label>
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
                  <input class="form-control" type="text" id="myagenda_sekolah_nama" name="myagenda_sekolah_nama" value="{{ Auth::user()->myagenda_user_nama }}" autofocus readonly />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="myagenda_sekolah_email" class="form-label">Email</label>
                  <input class="form-control" type="email" name="myagenda_sekolah_email" id="myagenda_sekolah_email" value="{{ Auth::user()->myagenda_user_email }}" required readonly />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="myagenda_sekolah_akreditasi" class="form-label">Akreditasi</label>
                  <input class="form-control" type="text" id="myagenda_sekolah_akreditasi" name="myagenda_sekolah_akreditasi" required />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="myagenda_sekolah_tlp" class="form-label">No. Tlp</label>
                  <input type="number" class="form-control" id="myagenda_sekolah_tlp" name="myagenda_sekolah_tlp" required />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="provinsi">Provinsi</label>
                  <select name="myagenda_sekolah_provinsi" id="provinsi" class="select2 form-select">
                    <option value="">--Pilih Provinsi--</option>
                    @foreach ($provinsi as $prv)
                    <option value="{{ $prv->id }}">{{ $prv->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="mb-3 col-md-6">
                  <label for="kabupaten">Kabupaten/Kota</label>
                  <select id="kabupaten" name="myagenda_sekolah_kab_kota" class="form-control">
                    <option value="">--Pilih Kabupaten/Kota--</option>
                  </select>
                </div>

                <div class="mb-3 col-md-6">
                  <label for="kecamatan">Kecamatan</label>
                  <select id="kecamatan" name="myagenda_sekolah_kec" class="form-control">
                    <option value="">--Pilih Kecamatan--</option>
                  </select>
                </div>

                <div class="mb-3 col-md-6">
                  <label for="kelurahan">Kelurahan</label>
                  <select id="kelurahan" name="myagenda_sekolah_kel" class="form-control">
                    <option value="">--Pilih Kelurahan--</option>
                  </select>
                </div>

                <div class="mb-3 col-md-6">
                  <label for="myagenda_sekolah_kodepos" class="form-label">Kode Pos</label>
                  <input type="number" class="form-control" id="myagenda_sekolah_kodepos" name="myagenda_sekolah_kodepos" required />
                </div>
                <div class="mb-3 col-md-6">
                  <label for="myagenda_sekolah_alamat" class="form-label">Alamat</label>
                  <textarea class="form-control" name="myagenda_sekolah_alamat" id="myagenda_sekolah_alamat" rows="3" required></textarea>
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
    const file = input.files[0]; // Get the selected file
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        const img = document.getElementById("logoPreview");
        const text = document.getElementById("logoPlaceholderText");

        img.src = e.target.result; // Set the src of the image
        img.style.display = "block"; // Show the image
        text.style.display = "none"; // Hide the placeholder text
      };
      reader.readAsDataURL(file);
    }
  }

  // Function to reset the image and placeholder
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

  $(document).ready(function() {
  $('#provinsi, #kabupaten, #kecamatan, #kelurahan').select2({
    width: '100%'
  });

  // Set awal supaya kabupaten, kecamatan, dan kelurahan disabled
  $('#kabupaten, #kecamatan, #kelurahan').prop('disabled', true);

  $('#provinsi').change(function() {
    var provinsi_id = $(this).val();
    if (provinsi_id) {
      $.ajax({
        url: '/kabupaten/' + provinsi_id,
        type: 'GET',
        success: function(data) {
          $('#kabupaten').html('<option value="">--Pilih Kabupaten/Kota--</option>').prop('disabled', false);
          $.each(data, function(key, value) {
            $('#kabupaten').append('<option value="' + value.id + '">' + value.name + '</option>');
          });

          $('#kecamatan').html('<option value="">--Pilih Kecamatan--</option>').prop('disabled', true);
          $('#kelurahan').html('<option value="">--Pilih Kelurahan--</option>').prop('disabled', true);
        },
        error: function() {
          alert('Gagal mengambil data kabupaten.');
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
        },
        error: function() {
          alert('Gagal mengambil data kecamatan.');
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
        },
        error: function() {
          alert('Gagal mengambil data kelurahan.');
        }
      });
    } else {
      $('#kelurahan').html('<option value="">--Pilih Kelurahan--</option>').prop('disabled', true);
    }
  });
});

</script>

@endsection