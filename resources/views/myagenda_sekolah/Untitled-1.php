<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Profile Details</h5>
      <!-- Account -->
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="../assets/img/avatars/1.png" alt="user-avatar" class="d-block rounded" height="100" width="100"
            id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload new photo</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="myagenda_sekolah_logo" class="account-file-input" name="myagenda_sekolah_logo" required/>
            </label>
            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
              <i class="bx bx-reset d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Reset</span>
            </button>

            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
          </div>
        </div>
      </div>
      <hr class="my-0" />
      <div class="card-body">
        <form id="formAccountSettings" method="POST" onsubmit="return false">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">Nama Sekolah</label>
              <input class="form-control" type="text" id="firstName" name="firstName" value="John" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="myagenda_sekolah_email" class="form-label">Email</label>
              <input class="form-control" type="email" name="myagenda_sekolah_email" id="myagenda_sekolah_email" required />
            </div>
            <div class="mb-3 col-md-6">
              <label for="myagenda_sekolah_akreditasi" class="form-label">Akreditasi</label>
              <input class="form-control" type="text" id="myagenda_sekolah_akreditasi" name="myagenda_sekolah_akreditasi" required/>
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

              <label for="kabupaten">Kabupaten/Kota</label>
              <select id="kabupaten" name="myagenda_sekolah_kab_kota" class="form-control">
                  <option value="">--Pilih Kabupaten/Kota--</option>
              </select>

              <label for="kecamatan">Kecamatan</label>
              <select id="kecamatan" name="myagenda_sekolah_kec" class="form-control">
                  <option value="">--Pilih Kecamatan--</option>
              </select>

              <label for="kelurahan">Kelurahan</label>
              <select id="kelurahan" name="myagenda_sekolah_kel" class="form-control">
                  <option value="">--Pilih Kelurahan--</option>
              </select>
          </div>
          <div class="mb-3 col-md-6">
            <label for="myagenda_sekolah_alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="myagenda_sekolah_alamat" name="myagenda_sekolah_alamat" required/>
          </div>
          <div class="mb-3 col-md-6">
            <label for="myagenda_sekolah_kodepos" class="form-label">Kode Pos</label>
            <input type="number" class="form-control" id="myagenda_sekolah_kodepos" name="myagenda_sekolah_kodepos" required />
          </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary" href="{{ route('myagenda_sekolah.index')}}">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
    <div class="card">
      <h5 class="card-header">Delete Account</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
            <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" onsubmit="return false">
          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
            <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
          </div>
          <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
        </form>
      </div>
    </div>
  </div>
</div>