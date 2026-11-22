@extends('template')
@section('title', 'Edit Kode Klasifikasi')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Kode Klasifikasi</h1>

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
                        <form action="{{ route('kode_klasifikasi.update', $kode_klasifikasi->id_kode_klasifikasi) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Kode Klasifikasi</label>
                                <input type="text" name="kode_klasifikasi"
                                    value="{{ old('kode_klasifikasi', $kode_klasifikasi->kode_klasifikasi) }}"
                                    class="form-control" placeholder="Kode Klasifikasi" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Klasifikasi</label>
                                <input type="text" name="nama_klasifikasi"
                                    value="{{ old('nama_klasifikasi', $kode_klasifikasi->nama_klasifikasi) }}"
                                    class="form-control" placeholder="Nama Klasifikasi" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="10">{{ old('deskripsi', $kode_klasifikasi->deskripsi) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Apakah ini merupakan anak dari kode klasifikasi lain?</label>
                                <select id="hasParent" class="form-select" onchange="toggleParentSelection()">
                                    <option value="no" {{ $kode_klasifikasi->id_parent_klasifikasi ? '' : 'selected' }}>
                                        Tidak</option>
                                    <option value="yes" {{ $kode_klasifikasi->id_parent_klasifikasi ? 'selected' : '' }}>
                                        Ya</option>
                                </select>
                            </div>

                            <div class="mb-3" id="parentSelection"
                                style="{{ $kode_klasifikasi->id_parent_klasifikasi ? 'display: block;' : 'display: none;' }}">
                                <label class="form-label">Pilih Parent Kode Klasifikasi</label>
                                <select name="id_parent_klasifikasi" id="parentSelect" class="form-select">
                                    <option value="">-- Pilih Parent --</option>
                                    @foreach ($parentKlasifikasi as $parent)
                                        <option value="{{ $parent->id_kode_klasifikasi }}"
                                            {{ old('id_parent_klasifikasi', $kode_klasifikasi->id_parent_klasifikasi) == $parent->id_kode_klasifikasi ? 'selected' : '' }}>
                                            [{{ $parent->kode_klasifikasi }}] {{ $parent->nama_klasifikasi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleParentSelection() {
            let selectBox = document.getElementById("hasParent");
            let parentSelection = document.getElementById("parentSelection");
            let parentSelect = document.getElementById("parentSelect");

            if (selectBox.value === "yes") {
                parentSelection.style.display = "block";
            } else {
                parentSelection.style.display = "none";
                parentSelect.value = "";
            }
        }
    </script>
@endsection
