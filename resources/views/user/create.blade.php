@extends('template')
@section('title', 'Tambah User')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tambah User</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama User</label>
                                <input type="text" name="nama_user" value="{{ old('nama_user') }}" class="form-control"
                                    placeholder="Nama User" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                    placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control"
                                    placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="text" name="password" value="{{ old('password') }}" class="form-control"
                                    placeholder="Password" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="" selected>Pilih Role</option>
                                    <option value="superadmin">Superadmin</option>
                                    <option value="admin bidang">Admin Bidang</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="form-control"
                                    placeholder="Jabatan" required>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
