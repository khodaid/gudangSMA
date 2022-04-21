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
        <form action="#" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="inputNama">Nama Satuan</label>
                <input name="nama" type="text" class="form-control" id="inputNama" aria-describedby="emailHelp" value="">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Satuan</label>
                <select name="kelamin" class="form-control" id="exampleFormControlSelect1">
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
                </select>
            </div
        </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning">Update</button>
        </form>
            </div>
    </div>
@endsection
