@extends('components.master-index')

@section('css')
<link href="{{ asset('sb/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
<div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    @include('components.topbar-admin')
                </ul>

            </nav>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="my-1 font-weight-bold text-primary">Barang</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="dataTable" width="100%"
                            cellspacing="0">
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
                                            <td><span
                                                    class="badge badge-primary">{{ $barang->kategori->nama }}</span>
                                            </td>
                                        @endif
                                        <td>
                                            <a href="#" class='fas fa-eye text-success'
                                                id="mediumButton" data-toggle="modal"
                                                data-target="#mediumModal"
                                                data-attr={{ route('cek-barang.show', $barang->id) }}></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade " id="mediumModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
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
        </div>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Logout</a>
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

    <script src="{{ asset('sb/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('sb/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('sb/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection
