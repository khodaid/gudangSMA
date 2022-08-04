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
                <div class="form-group">
                    <label for="inputPassword">Password</label>
                    <h6 class="text-danger">Diisi jika akan merubah password min 6 karakter</h6>
                    <input name="password" type="text" class="form-control" id="inputPassword" aria-describedby="emailHelp" >
                </div>
                @if (isset($user->pin))
                <div class="form-group">
                    <label for="inputPin">PIN</label>
                    <input name="pin" type="text" class="form-control" id="inputPin"
                        aria-describedby="emailHelp" onkeypress="return onlyNumberKey(event)" maxlength="6" value="{{old('pin') ?? $user->pin}}">
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        function onlyNumberKey(evt) {

            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }
    </script>
@endsection
