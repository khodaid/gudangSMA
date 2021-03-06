@extends('components.admin-master')

@section('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}
@endsection

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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Asal Dana</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('dana.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputNama">Nama Asal Dana</label>
                            <input name="nama" type="text" class="form-control" id="inputNama"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="inputDskripsi">Deskripsi</label>
                            <textarea class="form-control" id="inputDeskripsi" rows="3" name="deskripsi"></textarea>
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
    {{-- </div> --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h3 class="my-1 font-weight-bold text-primary">Asal Dana</h3>
            <div class="row">
                <div class="col-6 my-1">
                    <!-- Button trigger modal -->
                    @if (isset(Auth::user()->id_super))
                        <button type="button" class="btn btn-primary float-left" data-toggle="modal"
                            data-target="#exampleModal">
                            Tambah Data
                        </button>
                    @endif
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
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($danas as $dana)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $dana->nama }}</td>
                                <td>{{ Str::limit($dana->keterangan, 20) }}</td>
                                <td>
                                    @if (!isset(Auth::user()->roles) || $dana->id_user == Auth::id())
                                        <a href="{{ route('dana.edit', $dana->id) }}"
                                            class='fas fa-edit text-warning'></a>
                                        @if (count($dana->inventaris) == 0)
                                            <a href="#" class='fas fa-trash text-danger' data-toggle="modal"
                                                data-target="#modalDelete"
                                                onclick="$('#modalDelete #formDelete').attr('action','{{ route('dana.destroy', $dana->id) }}')"></a>
                                        @endif
                                    @endif
                                    <a href="#" class='fas fa-eye text-success' id="mediumButton" data-toggle="modal"
                                        data-target="#mediumModal" data-attr={{ route('dana.show', $dana->id) }}></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Data Asal Dana</h5>
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

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $('.my-select').selectpicker();
</script> --}}
@endsection
