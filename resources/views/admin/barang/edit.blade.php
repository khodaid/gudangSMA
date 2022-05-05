@extends('components.admin-master')

@section('content')
    <div class="container bg-white border py-3 rounded">
        <h3> Edit Dosen</h3>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('barang.update', $barang) }}" method="POST">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputNama">Nama Barang</label>
                        <input name="nama" type="text" class="form-control" id="inputNama" aria-describedby="emailHelp"
                            value="{{ old('nama') ?? $barang->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Satuan</label>
                        <select class="my-select form-control" id="exampleFormControlSelect1" name="satuan">
                            {{-- <option value="">Mustard</option> --}}
                            @foreach ($satuans as $satuan)
                                <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                            @endforeach
                        </select>
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
