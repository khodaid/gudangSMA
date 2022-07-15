@extends('components.admin-master')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="inputNama">Nama Barang</label>
                            <input name="nama" type="text" class="form-control" id="inputNama"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="inputKode">Kode Barang</label>
                            <input name="kode" type="text" class="form-control" id="inputKode"
                                aria-describedby="emailHelp" maxlength="20">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Satuan</label>
                            <select class="my-select form-control" id="exampleFormControlSelect1" name="satuan">
                                @foreach ($satuans as $satuan)
                                    <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Kategori Barang</label>
                            <select class="my-select form-control" id="exampleFormControlSelect1" name="kategori">
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
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
            <h3 class="my-1 font-weight-bold text-primary">Barang</h3>
            <div class="row">
                <div class="col-6 my-1">
                    <!-- Button trigger modal -->
                    @if (Auth::user()->roles == 2)
                        <button type="button" class="btn btn-primary float-left" data-toggle="modal"
                            data-target="#exampleModal">
                            Tambah Data
                        </button>
                    @endif
                </div>

                @if (Auth::user()->roles < 2)
                    <div class="col-6 d-flex justify-content-end my-1">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exportModal">
                            Export Excel
                        </button>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($barangs as $barang)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $barang->nama }}</td>
                                <td>{{ $barang->kode_barang }}</td>
                                @if ($barang->id_kategori == 1)
                                    <td>{{ $barang->inventaris->count() }}</td>
                                @else
                                    <td>{{ $barang->jumlah }}</td>
                                @endif
                                <td>{{ $barang->satuan->nama }}</td>
                                @if ($barang->id_kategori == 1)
                                    <td><span class="badge badge-secondary">Inventaris</span></td>
                                @else
                                    <td><span class="badge badge-primary">{{ $barang->kategori->nama }}</span></td>
                                @endif
                                <td>
                                    @if (Auth::id() == 2)
                                        <a href="{{ route('barang.edit', $barang->id) }}"
                                            class='fas fa-edit text-warning'></a>
                                        @if ($barang->id_kategori != 1)
                                            <a href="#" class='fas fa-trash text-danger' data-toggle="modal"
                                                data-target="#modalDelete"
                                                onclick="$('#modalDelete #formDelete').attr('action','{{ route('barang.destroy', $barang->id) }}')"></a>
                                        @endif
                                    @endif
                                    <a href="#" class='fas fa-eye text-success' id="mediumButton" data-toggle="modal"
                                        data-target="#mediumModal" data-attr={{ route('barang.show', $barang->id) }}></a>
                                    {{-- <a href="{{ route('barang.show', $barang->id) }}" class='fas fa-eye text-success'></a> --}}
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
                    <h5 class="modal-title" id="exampleModalLabel">Data Barang</h5>
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

    <div class="modal fade " id="exportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Export Jumlah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('barang.export') }}" method="post" id="formExport">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Kategori</label>
                            <select class="my-select form-control" id="exampleFormControlSelect1" name="kategori">
                                <option value="0">Semua</option>
                                @foreach ($kategoris as $kategori)
                                    <option value={{ $kategori->id }}>{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Export</button>
                    </div>
                </form>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $('.my-select').selectpicker();
    </script>
@endsection
