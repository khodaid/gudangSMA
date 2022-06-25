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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
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
                                aria-describedby="emailHelp" placeholder="minimal 6 karakter">
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
                        Tambah Data
                    </button>
                </div>

                {{-- <div class="col-6 d-flex justify-content-end my-1">
                    <button type="submit" class="btn btn-success float-left">Export Excel</button>
                </div> --}}
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
                                <td>{{ $user->roles }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $user->id) }}" class='fas fa-edit text-warning'></a>
                                    {{-- <a href="{{ route('user.destroy', $user->id) }}" class='fas fa-trash text-danger'></a> --}}
                                    <a href="#" class='fas fa-trash text-danger' data-toggle="modal"
                                            data-target="#modalDelete"
                                            onclick="$('#modalDelete #formDelete').attr('action','{{ route('user.destroy', $user->id) }}')"></a>
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

{{-- @push('script')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
@endpush --}}
