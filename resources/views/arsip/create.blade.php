@extends('template')
@section('title', 'Tambah Arsip')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tambah Arsip</h1>

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
                        <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nomor Arsip</label>
                                <input type="text" name="nomor_arsip" value="{{ old('nomor_arsip') }}"
                                    class="form-control" placeholder="Nomor Arsip" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Perihal</label>
                                <input type="text" name="perihal" value="{{ old('perihal') }}" class="form-control"
                                    placeholder="Perihal" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Surat</label>
                                <input type="date" name="tanggal_surat" value="{{ old('tanggal_surat') }}"
                                    class="form-control" placeholder="Tanggal Surat" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori Bidang Arsip</label>
                                <select name="id_kategori" id="id_kategori" class="form-control" required>
                                    <option value="" selected>Pilih Kategori Bidang Arsip</option>
                                    @foreach ($kategori_arsips as $kategori_arsip)
                                        <option value="{{ $kategori_arsip->id_kategori }}"
                                            {{ old('id_kategori') == $kategori_arsip->id_kategori ? 'selected' : '' }}>
                                            {{ $kategori_arsip->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kode Klasifikasi</label>
                                <select name="id_kode_klasifikasi" id="id_kode_klasifikasi" class="form-control" required>
                                    <option value="" selected>Pilih Kode Klasifikasi</option>
                                    @foreach ($kode_klasifikasis as $kode_klasifikasi)
                                        <option value="{{ $kode_klasifikasi->id_kode_klasifikasi }}"
                                            {{ old('id_kode_klasifikasi') == $kode_klasifikasi->id_kode_klasifikasi ? 'selected' : '' }}>
                                            {{ $kode_klasifikasi->kode_klasifikasi }} -
                                            {{ $kode_klasifikasi->nama_klasifikasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jenis Arsip</label>
                                <select name="jenis_arsip" id="jenis_arsip" class="form-control" required>
                                    <option value="" selected>Pilih Jenis Arsip</option>
                                    <option value="segera" {{ old('jenis_arsip') == 'segera' ? 'selected' : '' }}>Segera
                                    </option>
                                    <option value="rahasia" {{ old('jenis_arsip') == 'rahasia' ? 'selected' : '' }}>Rahasia
                                    </option>
                                    <option value="penting" {{ old('jenis_arsip') == 'penting' ? 'selected' : '' }}>Penting
                                    </option>
                                    <option value="biasa" {{ old('jenis_arsip') == 'biasa' ? 'selected' : '' }}>Biasa
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori Sifat</label>
                                <select name="kategori_sifat" id="kategori_sifat" class="form-control" required>
                                    <option value="" selected>Pilih Kategori Sifat</option>
                                    <option value="masuk" {{ old('kategori_sifat') == 'masuk' ? 'selected' : '' }}>Masuk
                                    </option>
                                    <option value="keluar" {{ old('kategori_sifat') == 'keluar' ? 'selected' : '' }}>Keluar
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pengirim</label>
                                <input type="text" name="pengirim" value="{{ old('pengirim') }}" class="form-control"
                                    placeholder="Pengirim" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Penerima</label>
                                <input type="text" name="penerima" value="{{ old('penerima') }}" class="form-control"
                                    placeholder="Penerima" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Rak</label>
                                <select name="id_rak" id="id_rak" class="form-control" required>
                                    <option value="" selected>Pilih Rak</option>
                                    @foreach ($raks as $rak)
                                        <option value="{{ $rak->id_rak }}"
                                            {{ old('id_rak') == $rak->id_rak ? 'selected' : '' }}>
                                            {{ $rak->nama_rak }} - {{ $rak->lokasi_rak }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">User Pemilik</label>
                                <select name="id_user_pemilik" id="id_user_pemilik" class="form-control" required>
                                    <option value="" selected>Pilih user</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id_user }}"
                                            {{ old('id_user_pemilik') == $user->id_user ? 'selected' : '' }}>
                                            {{ $user->nama_user }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lampiran File</label>
                                <input type="file" name="lampiran" class="form-control" required>
                                <small class="text-muted d-block ">
                                          Batas maksimal ukuran file: 2MB
                                </small>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
