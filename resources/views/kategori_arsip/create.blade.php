@extends('template')
@section('title', 'Tambah Kategori Arsip')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tambah Kategori Arsip</h1>

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
                        <form action="{{ route('kategori_arsip.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}" class="form-control"
                                    placeholder="Nama Kategori" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="10">{{ old('deskripsi') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
