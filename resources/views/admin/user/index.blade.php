@extends('components.admin-master')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Data Satuan</h1>
        <br>
    </div>

    <div class="col-6 mb-3">
    <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#exampleModal">
            Tambah Data
        </button>
    </div>

    <div class="col-6 d-flex justify-content-end mb-3">
        <button type="submit" class="btn btn-success float-left" >Export Excel</button>
    </div>


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
                    <div class="modal-body">
                        <form action="{{route('user.store')}}" method="POST">
                           @csrf
                            <div class="form-group">
                                <label for="inputNama">Nama Lengkap</label>
                                <input name="nama" type="text" class="form-control" id="inputNama" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail">Email</label>
                                <input name="email" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input name="password" type="text" class="form-control" id="inputPassword" aria-describedby="emailHelp">
                            </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    </div>

                    </div>
                </div>
            </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
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
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->roles}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
