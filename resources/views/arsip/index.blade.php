@extends('template')
@section('title', 'Data Arsip')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Data Arsip</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('arsip.create') }}" class="">
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
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Arsip</th>
                                        <th>Kategori Bidang</th>
                                        <th>Kode Klasifikasi</th>
                                        <th>Lokasi Arsip</th>
                                        <th>Status</th>
                                        <th>Sifat</th>
                                        <th class="col-2" style="white-space: nowrap;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($arsips as $key => $arsip)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($arsip->tanggal_surat)->format('d-m-Y') }}</td>
                                            <td>
                                                <b>Nomor Arsip :</b> {{ $arsip->nomor_arsip }} <br>
                                                <b>Perihal :</b> {{ $arsip->perihal }}
                                            </td>
                                            <td>{{ $arsip->tb_kategori_arsip->nama_kategori }}</td>
                                            <td>{{ $arsip->tb_kode_klasifikasi->kode_klasifikasi }} -
                                                {{ $arsip->tb_kode_klasifikasi->nama_klasifikasi }}</td>
                                                <td class="text-left"> {{ $arsip->tb_rak->nama_rak }}, {{ $arsip->tb_rak->lokasi_rak }}</td>
                                            <td>{{ ucwords($arsip->status_arsip) }}</td>
                                            <td>{{ ucwords($arsip->kategori_sifat) }}</td>
                                            <td>
                                                @if ($arsip->tb_lampiran && $arsip->tb_lampiran->url_file)
                                                    <a href="{{ route('arsip.download', $arsip->tb_lampiran->id_lampiran) }}"
                                                        class="btn btn-success" target="_blank">
                                                        <i class="align-middle" data-feather="download-cloud"></i>
                                                    </a>
                                                @else
                                                    <span class="text-danger">File tidak tersedia</span>
                                                @endif
                                                <a href="{{ route('arsip.show', $arsip->id_arsip) }}"
                                                    class="btn btn-primary"><i class="align-middle"
                                                        data-feather="eye"></i></a>
                                                @if (session('userdata')['role'] == 'superadmin' || session('userdata')['role'] == 'admin bidang')
                                                    <a href="{{ route('arsip.edit', $arsip->id_arsip) }}"
                                                        class="btn btn-primary"><i class="align-middle"
                                                            data-feather="edit-2"></i></a>
                                                    <button type="button" class="btn btn-danger delete-btn"
                                                        data-id="{{ $arsip->id_arsip }}">
                                                        <i class="align-middle" data-feather="trash"></i>
                                                    </button>
                                                @endif
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
                                form.action = `/arsip/${userId}`;

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
