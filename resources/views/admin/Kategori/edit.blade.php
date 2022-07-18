@extends('components.admin-master')

@section('content')
    <div class="container bg-white border py-3 rounded">
        <h3> Edit Lokasi</h3>
        @if (Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        <form action="{{ route('kategori.update', $kategori) }}" method="POST">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputNama">Nama Kategori</label>
                        <input name="nama" type="text" class="form-control" id="inputNama" aria-describedby="emailHelp"
                            value="{{ old('nama') ?? $kategori->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="inputDskripsi">Deskripsi</label>
                        <textarea class="form-control" id="inputDeskripsi" rows="3"
                            name="deskripsi">{{ old('deskripsi') ?? $kategori->deskripsi }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
