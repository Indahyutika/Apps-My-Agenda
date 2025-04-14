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
            <form method="POST" action="{{ route('myagenda_user.update', $user->myagenda_user_id) }}">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Edit Data User</h5>
                        <div class="card-body demo-vertical-spacing demo-only-element">

                            <div class="row">
                                <div class="col-md-4">
                                    <label for="myagenda_user_nama" class="form-label">Nama Sekolah</label>
                                    <div class="input-group">
                                        <span class="input-group-text">@</span>
                                        <input type="text" class="form-control" id="myagenda_user_nama" name="myagenda_user_nama" value="{{$user->myagenda_user_nama}}">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="myagenda_user_email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" id="myagenda_user_email" name="myagenda_user_email" value="{{$user->myagenda_user_email}}">
                                        <span class="input-group-text">@example.com</span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="myagenda_user_password" class="form-label">Password baru (Opsional)</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="myagenda_user_password" name="myagenda_user_password" placeholder="********">
                                        <span class="input-group-text cursor-pointer" id="togglePassword">
                                            <i class="bx bx-hide"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <button type="reset" class="btn btn-outline-secondary" onclick="window.location.href='{{ route('myagenda_user.index') }}'">Kembali</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        var passwordField = document.getElementById('myagenda_user_password');
        var icon = this.querySelector('i');

        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("bx-hide");
            icon.classList.add("bx-show");
        } else {
            passwordField.type = "password";
            icon.classList.remove("bx-show");
            icon.classList.add("bx-hide");
        }
    });
</script>
@endsection


<!--  value="{{ Auth::user()->myagenda_user_nama }}" -->