@extends('template')
@section('title', 'Detail Arsip')
@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Detail Arsip</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('arsip.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Nomor Arsip</th>
                                        <td>{{ $arsip->nomor_arsip }}</td>
                                    </tr>
                                    <tr>
                                        <th>Perihal</th>
                                        <td>{{ $arsip->perihal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Surat</th>
                                        <td>{{ \Carbon\Carbon::parse($arsip->tanggal_surat)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori Bidang</th>
                                        <td>{{ $arsip->tb_kategori_arsip->nama_kategori }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Klasifikasi</th>
                                        <td>{{ $arsip->tb_kode_klasifikasi->kode_klasifikasi }}-{{ $arsip->tb_kode_klasifikasi->nama_klasifikasi }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Arsip</th>
                                        <td>{{ $arsip->jenis_arsip }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kategori Sifat</th>
                                        <td>{{ $arsip->kategori_sifat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pengirim</th>
                                        <td>{{ $arsip->pengirim }}</td>
                                    </tr>
                                    <tr>
                                        <th>Penerima</th>
                                        <td>{{ $arsip->penerima }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pemilik</th>
                                        <td>{{ $arsip->tb_user->nama_user }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Rak</th>
                                        <td>{{ $arsip->tb_rak->nama_rak }} - {{ $arsip->tb_rak->lokasi_rak }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            <span class="badge bg-primary">{{ $arsip->status_arsip }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5>Lampiran</h5>
                                @if ($arsip->tb_lampiran && $arsip->tb_lampiran->url_file)
                                    @php
                                        $fileUrl = asset('storage/' . $arsip->tb_lampiran->url_file);
                                        $fileExtension = pathinfo($arsip->tb_lampiran->url_file, PATHINFO_EXTENSION);
                                    @endphp

                                    @if (in_array($fileExtension, ['pdf']))
                                        <iframe src="{{ $fileUrl }}" width="100%" height="500px"
                                            style="border: none;"></iframe>
                                    @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ $fileUrl }}" alt="Lampiran" class="img-fluid" />
                                    @else
                                        <a href="{{ $fileUrl }}" class="btn btn-success" target="_blank">Download
                                            Lampiran</a>
                                    @endif
                                    <div class="mt-3">
                                        <a href="{{ route('arsip.download', $arsip->tb_lampiran->id_lampiran) }}"
                                            class="btn btn-primary" target="_blank">
                                            Download Lampiran
                                        </a>
                                    </div>
                                @else
                                    <p class="text-danger">File lampiran tidak tersedia.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
