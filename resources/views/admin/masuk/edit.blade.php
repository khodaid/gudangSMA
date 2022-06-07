@extends('components.admin-master')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="container bg-white border py-3 rounded">
        <h3> Edit Transaksi Masuk</h3>
        @if (Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        <form action="{{ route('masuk.update', $masuk) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-6">

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Barang</label>
                        <select class="my-select form-control" id="exampleFormControlSelect1" name="barang">
                            <option value="{{ old('barang') ?? $masuk->barang->id }}">
                                {{ old('barang') ?? $masuk->barang->nama }}
                            </option>
                            @foreach ($barangs as $barang)
                                @if ($masuk->barang->id != $barang->id)
                                    <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputDskripsi">Deskripsi</label>
                        <textarea class="form-control" id="inputDeskripsi" rows="3"
                            name="deskripsi">{{ old('deskripsi') ?? $masuk->deskripsi }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="inputQuantity">Jumlah</label>
                                <input name="quantity" type="number" class="form-control" id="inputNama"
                                    aria-describedby="emailHelp" value="{{ old('quantity') ?? $masuk->jumlah }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Satuan</label>
                                <select class="my-select form-control" id="exampleFormControlSelect1" name="satuan">
                                    <option value="{{ old('satuan') ?? $masuk->satuan->id }}">
                                        {{ old('satuan') ?? $masuk->satuan->nama }}
                                    </option>
                                    @foreach ($satuans as $satuan)
                                        @if ($masuk->satuan->id != $satuan->id)
                                            <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputToko">Nama Toko</label>
                        <input name="toko" type="text" class="form-control" id="inputToko" aria-describedby="emailHelp"
                            value="{{ old('toko') ?? $masuk->nama_toko }}">
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="inputPembelian">Pembelian</label>
                                <input type="date" class="form-control" id="inputPembelian" aria-describedby="emailHelp"
                                    name="pembelian" value="{{ old('pembelian') ?? $masuk->tgl_pemesanan }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inputPenyerahan">Penyerahan</label>
                                <input type="date" class="form-control" id="inputPenyerhan" aria-describedby="emailHelp"
                                    name="penyerahan" value="{{ old('pembelian') ?? $masuk->tgl_penerimaan }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="inputHargaSatuan">Harga Satuan</label>
                                <input name="hrgSatuan" type="number" class="form-control" id="inputHargaSatuan"
                                    aria-describedby="emailHelp" value="{{ old('pembelian') ?? $masuk->harga_satuan }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="inputTotal">Harga Total</label>
                                <input name="hrgTotal" type="number" class="form-control" id="inputTotal"
                                    aria-describedby="emailHelp" value="{{ old('pembelian') ?? $masuk->jumlah_harga }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Bukti Scan Nota</label>
                            <h6 class="text-danger">*masukan file jika ingin merubah nota</h6>
                            <input type="file" class="form-control-file mb-2" id="exampleFormControlFile1" name="file"
                                value="{{ old('file') ?? $masuk->file }}">
                            <embed src="{{asset('/storage/files/'.$masuk->file) }} " type="application/pdf" width="400px" height="500px" />
                        </div>
                    </div>
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
