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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('satuan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputNama">Nama Satuan</label>
                            <input name="nama" type="text" class="form-control" id="inputNama"
                                aria-describedby="emailHelp">
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
            <h3 class="m-0 font-weight-bold text-primary">Satuan</h3>
            <div class="row">
                <div class="col-6 my-1">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-left" data-toggle="modal"
                        data-target="#exampleModal">
                        Tambah Data
                    </button>
                </div>

                <div class="col-6 d-flex justify-content-end my-1">
                    <button type="submit" class="btn btn-success float-left">Export Excel</button>
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
                            <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($satuans as $satuan)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $satuan->nama }}</td>
                                <td>
                                    @if (!isset(Auth::user()->roles) || $satuan->id_user == Auth::id())
                                        <a href="{{ route('satuan.edit', $satuan->id) }}" class='fas fa-edit'
                                            style='color:black'></a>
                                        <a href="{{ route('satuan.destroy', $satuan->id) }}" class='fas fa-trash'
                                            style='color:black'></a>
                                    @endif
                                    <a href="#" class='fas fa-eye' style='color:black' id="mediumButton" data-toggle="modal"
                                        data-target="#mediumModal" data-attr={{ route('satuan.show', $satuan->id) }}></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade " id="mediumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Satuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    {{-- isi view lihat data --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- coba modal --}}
    <script>
        $(document).on('click', '#mediumButton', function(event) {
            event.preventDefault();
            let href = $(this).attr('data-attr');
            $.ajax({
                url: href,
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#mediumModal').modal("show");
                    $('#mediumBody').html(result).show();
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });
    </script>
    {{-- akhir coba model --}}
@endsection
