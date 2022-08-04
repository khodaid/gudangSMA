@extends('components.admin-master')

@section('content')
    @if ($message = Session::get('update'))
        <div class="alert alert-warning" role="alert">
            {{ $message }}
        </div>
    @elseif($message = Session::get('hapus'))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @elseif($message = Session::get('store'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputNama">Nama Lengkap</label>
                            <input name="nama" type="text" class="form-control" id="inputNama"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input name="email" type="email" class="form-control" id="inputEmail"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input name="password" type="text" class="form-control" id="inputPassword"
                                aria-describedby="emailHelp" placeholder="minimal 8 karakter">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade " id="modalPublic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User Public</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('user.storePublic') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputNama">Nama Lengkap</label>
                            <input name="nama" type="text" class="form-control" id="inputNama"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">Email</label>
                            <input name="email" type="email" class="form-control" id="inputEmail"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input name="password" type="text" class="form-control" id="inputPassword"
                                aria-describedby="emailHelp" placeholder="minimal 8 karakter">
                        </div>
                        <div class="form-group">
                            <label for="inputPin">PIN</label>
                            <input name="pin" type="text" class="form-control" id="inputPin"
                                aria-describedby="emailHelp" onkeypress="return onlyNumberKey(event)" maxlength="6" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="m-0 font-weight-bold text-primary">User</h3>
            <div class="row">
                <div class="col-6 my-1">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-left" data-toggle="modal"
                        data-target="#exampleModal">
                        Tambah Admin
                    </button>
                </div>

                <div class="col-6 d-flex justify-content-end my-1">
                    <button type="button" class="btn btn-success float-left" data-toggle="modal"
                        data-target="#modalPublic">
                        Tambah Public
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @if ($user->roles == 2)
                                    <td><span class="badge badge-primary">Admin</span></td>
                                @else
                                    <td><span class="badge badge-success">Public</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}" class='fas fa-edit text-warning'></a>
                                    {{-- <a href="{{ route('user.destroy', $user->id) }}" class='fas fa-trash text-danger'></a> --}}
                                    @if (count($user->pengambil) == 0 && count($user->dana) == 0)
                                    <a href="#" class='fas fa-trash text-danger' data-toggle="modal"
                                        data-target="#modalDelete"
                                        onclick="$('#modalDelete #formDelete').attr('action','{{ route('user.destroy', $user->id) }}')"></a>
                                    @endif
                                    {{-- <a href="#" class='fas fa-eye text-success'  id="mediumButton" data-toggle="modal"
                                        data-target="#mediumModal" data-attr={{ route('user.show', $user->id) }}></a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade " id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Hapus Data ini?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <form action="" method="get" id="formDelete">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
