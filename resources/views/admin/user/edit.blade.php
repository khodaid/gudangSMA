@extends('components.admin-master')

@section('content')
    <h3>Edit User</h3>
    @if (Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{$message}}
        </div>
    @endif
    <form action="{{route('user.update',$user)}}" method="POST">
        <div class="row">
            <div class="col-lg-6">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="inputNama">Nama User</label>
                    <input name="nama" type="text" class="form-control" id="inputNama" aria-describedby="emailHelp" value="{{old('nama') ?? $user->name}}">
                </div>
                <div class="form-group">
                    <label for="inputEmail">Email</label>
                    <input name="email" type="text" class="form-control" id="inputEmail" aria-describedby="emailHelp" value="{{old('email') ?? $user->email}}">
                </div>
                {{-- <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <input name="password" type="text" class="form-control" id="inputPassword" aria-describedby="emailHelp" value="{{old('password') ?? decrypt($user->email)}}">
                </div> --}}
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection
