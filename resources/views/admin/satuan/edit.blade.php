@extends('components.admin-master')

@section('content')
    <h1> Edit Dosen</h1>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
        <form action="{{route('satuan.update',[$satuan])}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="inputNama">Nama Satuan</label>
                <input name="nama" type="text" class="form-control" id="inputNama" aria-describedby="emailHelp" value="{{old('nama') ?? $satuan->nama}}">
            </div>
        </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Update</button>
        </form>
            </div>
    </div>
@endsection
