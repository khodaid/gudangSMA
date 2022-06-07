<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="my-1 font-weight-bold text-primary">Inventaris Rusak Ringan</h3>
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
                            <td>{{ $inventaris->harga }}</td>
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
