@extends('template')
@section('title', 'Edit User')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit User</h1>
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
                        <form action="{{ route('user.update', $user->id_user) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Nama User</label>
                                <input type="text" name="nama_user" value="{{ $user->nama_user }}" class="form-control"
                                    placeholder="Nama User" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="form-control"
                                    placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" value="{{ $user->username }}" class="form-control"
                                    placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password <small>(isi jika ingin ganti password)</small></label>
                                <input type="text" name="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select name="role" id="role" class="form-control" required>
                                    <option value="superadmin" {{ $user->role == 'superadmin' ? 'selected' : '' }}>
                                        Superadmin
                                    </option>
                                    <option value="admin bidang" {{ $user->role == 'admin bidang' ? 'selected' : '' }}>Admin
                                        Bidang</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" value="{{ $user->jabatan }}" class="form-control"
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
