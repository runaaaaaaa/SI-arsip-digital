@extends('template')
@section('title', 'Edit Rak')
@section('content')
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Rak</h1>
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
                        <form action="{{ route('rak.update', $rak->id_rak) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Nama Rak</label>
                                <input type="text" name="nama_rak" value="{{ $rak->nama_rak }}" class="form-control"
                                    placeholder="Nama Rak" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Lokasi Rak</label>
                                <input type="text" name="lokasi_rak" value="{{ $rak->lokasi_rak }}" class="form-control"
                                    placeholder="Lokasi Rak" required>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
