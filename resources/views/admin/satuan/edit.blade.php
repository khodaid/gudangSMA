@extends('components.admin-master')

@section('content')
    <h3> Edit Dosen</h3>
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif

    <form action="{{route('satuan.update',$satuan)}}" method="POST">
        <div class="row">
            <div class="col-lg-6">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="inputNama">Nama Satuan</label>
                    <input name="nama" type="text" class="form-control" id="inputNama" aria-describedby="emailHelp" value="{{old('nama') ?? $satuan->nama}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection
