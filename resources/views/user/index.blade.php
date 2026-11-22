@extends('template')
@section('title', 'Data User')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Data User</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('user.create') }}" class="btn btn-success">
                            Tambah Data
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="userTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $user->nama_user }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ ucwords($user->role) }}</td>
                                            <td>{{ $user->jabatan }}</td>
                                            <td>
                                                <a href="{{ route('user.edit', $user->id_user) }}"
                                                    class="btn btn-primary"><i class="align-middle"
                                                        data-feather="edit-2"></i></a>
                                                <button type="button" class="btn btn-danger delete-btn"
                                                    data-id="{{ $user->id_user }}">
                                                    <i class="align-middle" data-feather="trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteButtons = document.querySelectorAll('.delete-btn');

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const userId = this.getAttribute('data-id');

                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data ini akan dihapus secara permanen!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, Hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const form = document.createElement('form');
                                form.method = 'POST';
                                form.action = `/user/${userId}`;

                                const csrfToken = document.createElement('input');
                                csrfToken.type = 'hidden';
                                csrfToken.name = '_token';
                                csrfToken.value = '{{ csrf_token() }}';
                                form.appendChild(csrfToken);

                                const methodField = document.createElement('input');
                                methodField.type = 'hidden';
                                methodField.name = '_method';
                                methodField.value = 'DELETE';
                                form.appendChild(methodField);

                                document.body.appendChild(form);
                                form.submit();
                            }
                        });
                    });
                });
            });
        </script>
    @endpush
@endsection
