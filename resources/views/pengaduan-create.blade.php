@extends('components.master-index')

@section('content')

    <div class="container h-100 my-auto py-3">
        <div class="row align-items-center">
            <div class="col">
                <div class="card m-3 p-3">
                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nomerPengaduan">Nomer Pengaduan</label>
                            <input type="text" class="form-control" name="nomer" id="nomerPengaduan" aria-describedby="emailHelp"
                                value="{{ $nomer }}" readonly>
                            <small id="emailHelp" class="form-text text-muted">catat nomer pengaduan</small>
                        </div>
                        <div class="form-group">
                            <label for="namaPelapor">Nama Pelapor</label>
                            <input type="text" class="form-control" name="nama" id="namaPelapor" aria-describedby="emailHelp"
                                placeholder="masukan nama anda">
                        </div>
                        <div class="form-group">
                            <label for="departement">Departement</label>
                            <input type="text" class="form-control" name="departement" id="departement" aria-describedby="emailHelp"
                                placeholder="masukan nama departemen anda">
                        </div>
                        <div class="form-group">
                            <label for="namabarang">Nama Barang</label>
                            <input type="text" class="form-control" name="barang" id="namaBarang" aria-describedby="emailHelp"
                                placeholder="masukan nama barang">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control-file" name="foto" id="foto"  accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="departement">Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" id="departement" aria-describedby="emailHelp"
                                placeholder="masukan lokasi kerusakan">
                        </div>
                        <button type="submit" class="btn btn-primary">Laporkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
