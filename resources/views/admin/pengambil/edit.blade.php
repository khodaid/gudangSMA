@extends('components.admin-master')

@section('content')
    <div class="container bg-white border py-3 rounded">
        <h3> Edit Pengambil</h3>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('pengambil.update', $pengambil) }}" method="POST">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputNama">Nama Pengambil</label>
                        <input name="nama" type="text" class="form-control" id="inputNama" aria-describedby="emailHelp"
                            value="{{ old('nama') ?? $pengambil->nama }}" maxlength="30">
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Jabatan</label>
                        <input name="jabatan" type="text" class="form-control" id="inputKode" aria-describedby="emailHelp"
                            value="{{ old('jabatan') ?? $pengambil->jabatan }}" maxlength="20" >
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

