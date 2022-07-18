@extends('components.admin-master')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="container bg-white border py-3 rounded">
        <h3> Edit Transaksi Keluar</h3>
        @if (Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        <form action="{{ route('keluar.update', $keluar) }}" method="POST">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Barang</label>
                        <select class="my-select form-control" id="exampleFormControlSelect1" name="barang">
                            <option value="{{ old('barang') ?? $keluar->barang->id }}">
                                {{ old('barang') ?? $keluar->barang->nama }}
                            </option>
                            @foreach ($barangs as $barang)
                                @if ($keluar->barang->id != $barang->id)
                                    <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputQuantity">Jumlah</label>
                                <input name="quantity" type="number" class="form-control" id="inputNama"
                                    aria-describedby="emailHelp" value="{{ old('quantity') ?? $keluar->jumlah }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Satuan</label>
                                <select class="my-select form-control" id="exampleFormControlSelect1" name="satuan">
                                    <option value="{{ old('satuan') ?? $keluar->satuan->id }}">
                                        {{ old('satuan') ?? $keluar->satuan->nama }}
                                    </option>
                                    @foreach ($satuans as $satuan)
                                        @if ($keluar->satuan->id != $satuan->id)
                                            <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nama Pengambil</label>
                        <select class="my-select form-control" id="exampleFormControlSelect1" name="pengambil">
                            <option value="{{ old('pengambil') ?? $keluar->pengambil->id }}">
                                {{ old('pengambil') ?? $keluar->pengambil->nama }}
                            </option>
                            @foreach ($pengambils as $pengambil)
                            @if ($keluar->pengambil->id != $pengambil->id)
                            <option value="{{ $pengambil->id }}">{{ $pengambil->nama }}</option>
                                        @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="inputPengambilan">Pengambilan</label>
                        <input type="date" class="form-control" id="inputPengambilan" aria-describedby="emailHelp"
                            name="tglPengambilan" value="{{ old('pengambilan') ?? $keluar->tgl_keluar }}">
                    </div>
                    <div class="form-group">
                        <label for="inputDskripsi">Deskripsi</label>
                        <textarea class="form-control" id="inputDeskripsi" rows="3" name="deskripsi">{{ old('deskripsi') ?? $keluar->deskripsi }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-warning">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script>
        $('.my-select').selectpicker();
    </script>
@endsection
