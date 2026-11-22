@extends('template')
@section('title', 'Data Rak')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Lokasi Rak</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('rak.create') }}" class="">
                            <button class="btn btn-success">
                                Tambah Data
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="userTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Rak</th>
                                        <th scope="col">Lokasi Rak</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($raks as $key => $rak)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $rak->nama_rak }}</td>
                                            <td>{{ $rak->lokasi_rak }}</td>
                                            <td>
                                                <a href="{{ route('rak.edit', $rak->id_rak) }}" class="btn btn-primary"><i
                                                        class="align-middle" data-feather="edit-2"></i></a>
                                                <button type="button" class="btn btn-danger delete-btn"
                                                    data-id="{{ $rak->id_rak }}">
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
                                form.action = `/rak/${userId}`;

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
