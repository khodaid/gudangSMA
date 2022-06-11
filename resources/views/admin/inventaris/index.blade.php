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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Modal -->
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Inventaris Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('inventaris.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Barang</label>
                            <select class="my-select form-control" id="exampleFormControlSelect1" name="id_barang">
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="inputKode">Kode</label>
                                    <input name="kode[]" type="text" class="form-control" id="inputKode"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <div class="form-group ">
                                    <a href="#" class="btn btn-success mt-4 btnKode">Tambah Kode</a>
                                </div>
                            </div>
                        </div>
                        <div class="addKode">
                        </div>
                        <div class="form-group">
                            <label for="inputPembukuan">Pembukuan</label>
                            <input type="date" class="form-control" id="inputPembukuan" aria-describedby="emailHelp"
                                name="pembukuan">
                        </div>
                        <div class="form-group">
                            <label for="inputDskripsi">Deskripsi</label>
                            <textarea class="form-control" id="inputDeskripsi" rows="3" name="deskripsi"></textarea>
                        </div>
                        {{-- <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputQuantity">Jumlah</label>
                                    <input name="jumlah" type="number" class="form-control" id="inputNama"
                                        aria-describedby="emailHelp">
                                </div>
                            </div> --}}
                        {{-- <div class="col"> --}}
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Satuan</label>
                            <select class="my-select form-control" id="exampleFormControlSelect1" name="id_satuan">
                                @foreach ($satuans as $satuan)
                                    <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- </div> --}}
                        {{-- </div> --}}
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputPembuatan">Pembuatan</label>
                                    <input type="text" class="form-control" id="inputPembuatan"
                                        aria-describedby="emailHelp" name="pembuatan">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="inputPenyerahan">Penyerahan</label>
                                    <input type="date" class="form-control" id="inputPenyerhan"
                                        aria-describedby="emailHelp" name="penyerahan">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Asal Dana</label>
                                    <select class="my-select form-control" id="exampleFormControlSelect1" name="id_dana">
                                        @foreach ($danas as $dana)
                                            <option value="{{ $dana->id }}">{{ $dana->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- </div>
                        <div class="row"> --}}
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputHargaSatuan">Harga Satuan</label>
                                    <input name="harga" type="number" class="form-control" id="inputHargaSatuan"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Bukti Scan Nota</label>
                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
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
            <h3 class="my-1 font-weight-bold text-primary">Transaksi Inventaris</h3>
            <div class="row">
                <div class="col-6 my-1">
                    <!-- Button trigger modal -->
                    {{-- @if (isset(Auth::user()->id_super)) --}}
                    <button type="button" class="btn btn-primary float-left" data-toggle="modal"
                        data-target="#exampleModal">
                        Tambah Data
                    </button>
                    {{-- @endif --}}
                </div>

                <div class="col-6 d-flex justify-content-end my-1">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exportModal">
                        Export Excel
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
                            <th>Pembukuan</th>
                            <th>Kode</th>
                            <th>Barang</th>
                            {{-- <th>Deskripsi</th> --}}
                            <th>Jumlah</th>
                            {{-- <th>Satuan</th> --}}
                            {{-- <th>Tahun Pembuatan</th> --}}
                            <th>Dana</th>
                            <th>Penyerahan</th>
                            <th>Kondisi</th>
                            <th>Harga</th>
                            {{-- <th>Jumlah Harga</th> --}}
                            @if (!isset(Auth::user()->id_super))
                                <th>User Pembuat</th>
                            @endif
                            <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($inventariss as $inventaris)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ date('d-m-Y', strtotime($inventaris->tgl_pembukuan)) }}</td>
                                <td>{{ $inventaris->kode }}</td>
                                <td>{{ $inventaris->barang->nama }}</td>
                                {{-- <td>{{ Str::limit($inventaris->deskripsi, 20) }}</td> --}}
                                <td>{{ $inventaris->jumlah . ' ' . $inventaris->satuan->nama }}</td>
                                {{-- <td>{{ $inventaris->satuan->nama }}</td> --}}
                                {{-- <td>{{ $inventaris->thn_pembuatan }} </td> --}}
                                <td>{{ $inventaris->dana->nama }} </td>
                                <td>{{ date('d-m-Y', strtotime($inventaris->tgl_penyerahan)) }}</td>
                                @if ($inventaris->kondisi == 1)
                                    <td><span class="badge badge-success">Baik</span></td>
                                @elseif ($inventaris->kondisi == 2)
                                    <td><span class="badge badge-warning">Rusak Ringan</span></td>
                                @else
                                    <td><span class="badge badge-danger">Rusak Berat</span></td>
                                @endif
                                <td>Rp.{{ number_format($inventaris->harga) }}</td>
                                {{-- <td>{{ $inventaris->hrg_total }}</td> --}}
                                @if (!isset(Auth::user()->id_super))
                                    <td>{{ $inventaris->user->name }}</td>
                                @endif
                                <td>
                                    @if ($inventaris->id_user == Auth::id())
                                        <a href="{{ route('inventaris.edit', $inventaris->id) }}"
                                            class='fas fa-edit text-warning'></a>
                                        <a href="#" class='fas fa-flag text-danger' id="deleteData" data-toggle="modal" data-target="#modalDelete"
                                            onclick="$('#modalDelete #formDelete').attr('action','{{ route('inventaris.rusak', $inventaris->id) }}')"></a>
                                        @if ($inventaris->kondisi != 1)
                                        @endif
                                    @endif
                                    <a href="#" class='fas fa-eye text-success' id="mediumButton" data-toggle="modal"
                                        data-target="#mediumModal"
                                        data-attr={{ route('inventaris.show', $inventaris->id) }}></a>
                                    {{-- <a href="#" class='' id="mediumButton" data-toggle="modal"
                                        data-target="#mediumModal" data-attr={{ route('inventaris.pdf', $inventaris->id) }}><span class="badge badge-success">PDF</span></a> --}}
                                    <a href="#" class='fas fa-file-pdf' id="mediumButton" data-toggle="modal" data-target="#mediumModal"
                                        data-attr={{ route('inventaris.pdf', $inventaris->id) }}></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Inventaris</h5>
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
                    <h5 class="modal-title" id="exampleModalLabel">Export Transaksi Inventaris</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('inventaris.export') }}" method="post" id="formExport">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inputPenyerahan">Dari Tanggal</label>
                            <input type="date" class="form-control" id="inputPenyerhan" aria-describedby="emailHelp"
                                name="dari">
                        </div>

                        <div class="form-group">
                            <label for="inputPenyerahan">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="inputPenyerhan" aria-describedby="emailHelp"
                                name="sampai">
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
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Barang Ini Rusak?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST" id="formDelete">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" id="mediumBody">
                        {{-- <div class="form-group">
                            <label for="inputPembukuan">Pembukuan</label>
                            <input type="date" class="form-control" id="inputPembukuan" aria-describedby="emailHelp"
                                name="pembukuan">
                        </div> --}}
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Rusak</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="kondisi">
                                <option value="2">Rusak Ringan</option>
                                <option value="3">Rusak Berat</option>
                            </select>
                            {{-- </div>
                        <div class="form-group">
                            <label for="inputQuantity">Jumlah</label>
                            <input name="jumlah" type="number" class="form-control" id="inputNama"
                                aria-describedby="emailHelp">
                        </div> --}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Rusak</button>
                        </div>
                </form>
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

    <script>
        $(document).ready(function(e) {
            $('.btnKode').click(function(e) {
                e.preventDefault();

                $('.addKode').append(
                    `<div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="inputKode">Kode</label>
                                    <input name="kode[]" type="text" class="form-control" id="inputKode"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-center">
                                <div class="form-group ">
                                    <a href="#" class="btn btn-danger mt-4 remove">hapus</a>
                                </div>
                            </div>
                        </div>`
                );

            });
        });

        $(document).on('click', '.remove', function(e) {
            e.preventDefault();
            $(this).parents('.row').remove();
        });
    </script>
@endsection
