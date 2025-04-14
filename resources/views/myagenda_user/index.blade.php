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
        <a href="{{ route('myagenda_user.create') }}" class="btn btn-outline-primary">
            <i class="bx bx-plus"></i>&nbsp; Tambah
        </a>
    </div>

    <form action="{{ route('myagenda_user.index') }}" method="GET">
        <div class="card">
            <h5 class="card-header">USER</h5>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No</th>
                                <th>Nama Sekolah</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                        <tbody style="text-align: center;">
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$user->myagenda_user_nama}}</td>
                                <td>{{$user->myagenda_user_email}}</td>
                                <!-- <td>{{$user->myagenda_user_password}}</td> -->
                                <td>{{$user->myagenda_user_role}}</td>
                                <td>
                                    <a href="{{ route('myagenda_user.edit', $user->myagenda_user_id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bx bx-edit-alt me-1"></i>
                                    </a>
                                    <form action="{{ route('myagenda_user.destroy', $user->myagenda_user_id) }}" method="POST" class="d-inline">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
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
        @endsection
        