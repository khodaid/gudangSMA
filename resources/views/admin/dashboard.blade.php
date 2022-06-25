@extends('components.admin-master')

@section('content')
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="#" class="bar-item" data-id="1">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Barang Menipis</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ sizeof($menipis) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-question-circle fa-2x text-warning" aria-hidden="true"></i>
                                {{-- <i class="fas fa-calendar fa-2x text-gray-300"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="#" class="bar-item" data-id="2">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Barang Habis</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ sizeof($habis) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                                {{-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="#" class="bar-item" data-id="3">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Inventaris Rusak Ringan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($ringan) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-question-circle fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="#" class="bar-item" data-id="4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Inventaris Rusak Berat</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($berat) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="card shadow mb-4 item data-1">
        <div class="card-header py-3">
            <h3 class="my-1 font-weight-bold text-primary">Barang Menipis</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered dataTable1" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            {{-- <th>Aksi</th> --}}
                    </thead>
                    <tbody>
                        @foreach ($menipis as $barang)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                {{-- @dd($barang) --}}
                                <td>{{ $barang->nama }}</td>
                                <td>{{ $jumlahMenipis[$barang->id]['jumlah'] }}</td>
                                <td>{{ $barang->satuan->nama }}</td>
                                @if ($barang->kategori)
                                    <td><span class="badge badge-secondary">Inventaris</span></td>
                                @else
                                    <td><span class="badge badge-primary">Umum</span></td>
                                @endif
                                {{-- <td>
                                    <a href="#" class='fas fa-eye text-success' id="mediumButton" data-toggle="modal"
                                        data-target="#mediumModal" data-attr={{ route('barang.show', $barang->id) }}></a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 item data-2">
        <div class="card-header py-3">
            <h3 class="my-1 font-weight-bold text-primary">Barang Habis</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered dataTable2" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Kategori</th>
                            {{-- <th>Aksi</th> --}}
                    </thead>
                    <tbody>
                        @foreach ($habis as $barang)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                {{-- @dd($barang) --}}
                                <td>{{ $barang->nama }}</td>
                                <td>{{ $jumlahHabis[$barang->id]['jumlah'] }}</td>
                                <td>{{ $barang->satuan->nama }}</td>
                                @if ($barang->kategori)
                                    <td><span class="badge badge-secondary">Inventaris</span></td>
                                @else
                                    <td><span class="badge badge-primary">Umum</span></td>
                                @endif
                                {{-- <td>
                                    <a href="#" class='fas fa-eye text-success' id="mediumButton" data-toggle="modal"
                                        data-target="#mediumModal" data-attr={{ route('barang.show', $barang->id) }}></a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 item data-3">
        <div class="card-header py-3">
            <h3 class="my-1 font-weight-bold text-primary">Inventaris Rusak Ringan</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered dataTable3" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pembukuan</th>
                            <th>Kode</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Dana</th>
                            <th>Penyerahan</th>
                            <th>Kondisi</th>
                            <th>Harga</th>
                            @if (!isset(Auth::user()->id_super))
                                <th>User Pembuat</th>
                            @endif
                            <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($ringan as $inventaris)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ date('d-m-Y', strtotime($inventaris->tgl_pembukuan)) }}</td>
                                <td>{{ $inventaris->kode }}</td>
                                <td>{{ $inventaris->barang->nama }}</td>
                                <td>{{ $inventaris->jumlah . ' ' . $inventaris->satuan->nama }}</td>
                                <td>{{ $inventaris->dana->nama }} </td>
                                <td>{{ date('d-m-Y', strtotime($inventaris->tgl_penyerahan)) }}</td>
                                @if ($inventaris->kondisi == 1)
                                    <td><span class="badge badge-success">Baik</span></td>
                                @elseif ($inventaris->kondisi == 2)
                                    <td><span class="badge badge-warning">Rusak Ringan</span></td>
                                @else
                                    <td><span class="badge badge-danger">Rusak Berat</span></td>
                                @endif
                                <td>Rp. {{ number_format($inventaris->harga) }}</td>
                                @if (!isset(Auth::user()->id_super))
                                    <td>{{ $inventaris->user->name }}</td>
                                @endif
                                <td>
                                    <a href="#" class='fas fa-eye text-success' id="mediumButton" data-toggle="modal"
                                        data-target="#mediumModal"
                                        data-attr={{ route('inventaris.show', $inventaris->id) }}></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 item data-4">
        <div class="card-header py-3">
            <h3 class="my-1 font-weight-bold text-primary">Inventaris Rusak Berat</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered dataTable4" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pembukuan</th>
                            <th>Kode</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Dana</th>
                            <th>Penyerahan</th>
                            <th>Kondisi</th>
                            <th>Harga</th>
                            @if (!isset(Auth::user()->id_super))
                                <th>User Pembuat</th>
                            @endif
                            <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($berat as $inventaris)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ date('d-m-Y', strtotime($inventaris->tgl_pembukuan)) }}</td>
                                <td>{{ $inventaris->kode }}</td>
                                <td>{{ $inventaris->barang->nama }}</td>
                                <td>{{ $inventaris->jumlah . ' ' . $inventaris->satuan->nama }}</td>
                                <td>{{ $inventaris->dana->nama }} </td>
                                <td>{{ date('d-m-Y', strtotime($inventaris->tgl_penyerahan)) }}</td>
                                @if ($inventaris->kondisi == 1)
                                    <td><span class="badge badge-success">Baik</span></td>
                                @elseif ($inventaris->kondisi == 2)
                                    <td><span class="badge badge-warning">Rusak Ringan</span></td>
                                @else
                                    <td><span class="badge badge-danger">Rusak Berat</span></td>
                                @endif
                                <td>Rp. {{ number_format($inventaris->harga) }}</td>
                                @if (!isset(Auth::user()->id_super))
                                    <td>{{ $inventaris->user->name }}</td>
                                @endif
                                <td>
                                    <a href="#" class='fas fa-eye text-success' id="mediumButton" data-toggle="modal"
                                        data-target="#mediumModal"
                                        data-attr={{ route('inventaris.show', $inventaris->id) }}></a>
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
    <script>
        // $(document).ready(function(){
        //     $('.card-ringan').click(function(){
        //         $('.card').load('dash-ringan');
        //     });
        // });
        $(document).ready(function() {
            $('.item').slice(1).hide()
            $('.bar-item').on('click', function() {
                let _id = $(this).data('id');
                $('.item').hide()
                $('.data-' + _id).css('display', 'block')
                let table = $('.dataTable').DataTable();
                table.destroy();
                $('.dataTable'+_id).DataTable({
                    responsive: true
                });
            })
        });
    </script>
@endsection
