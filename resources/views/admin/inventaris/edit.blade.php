@extends('components.admin-master')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    <div class="container bg-white border py-3  mb-3 rounded">
        <h3>Inventaris</h3>
        @if (Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        <form action="{{ route('inventaris.update', $inventaris) }}" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Barang</label>
                                <select class="my-select form-control" id="exampleFormControlSelect1" name="id_barang">
                                    <option value="{{ old('id_barang') ?? $inventaris->barang->id }}">
                                        {{ old('id_barang') ?? $inventaris->barang->nama }}
                                    </option>
                                    @foreach ($barangs as $barang)
                                        @if ($inventaris->barang->id != $barang->id)
                                            <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="inputKode">Kode</label>
                                <input name="kode" type="text" class="form-control" id="inputKode"
                                    aria-describedby="emailHelp" value="{{ old('kode') ?? $inventaris->kode }} ">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPembukuan">Pembukuan</label>
                        <input type="date" class="form-control" id="inputPembukuan" aria-describedby="emailHelp"
                            name="pembukuan" value="{{ old('pembukuan') ?? $inventaris->tgl_pembukuan }}">
                    </div>
                    <div class="form-group">
                        <label for="inputDskripsi">Deskripsi</label>
                        <textarea class="form-control" id="inputDeskripsi" rows="3" name="deskripsi">{{ old('deskripsi') ?? $inventaris->deskripsi }}</textarea>
                    </div>
                    {{-- <div class="row"> --}}
                    {{-- <div class="col">
                            <div class="form-group">
                                <label for="inputQuantity">Jumlah</label>
                                <input name="jumlah" type="number" class="form-control" id="inputNama"
                                    aria-describedby="emailHelp" value="{{ old('quantity') ?? $inventaris->jumlah }}">
                            </div>
                        </div> --}}
                    {{-- <div class="col"> --}}
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Satuan</label>
                        <select class="my-select form-control" id="exampleFormControlSelect1" name="id_satuan">
                            <option value="{{ old('id_satuan') ?? $inventaris->satuan->id }}">
                                {{ old('id_satuan') ?? $inventaris->satuan->nama }}
                            </option>
                            @foreach ($satuans as $satuan)
                                @if ($inventaris->satuan->id != $satuan->id)
                                    <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    {{-- </div> --}}
                    {{-- </div> --}}
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="inputPembuatan">Pembuatan</label>
                                <input type="text" class="form-control" id="inputPembuatan" aria-describedby="emailHelp"
                                    name="pembuatan" value="{{ old('pembuatan') ?? $inventaris->thn_pembuatan }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="inputPenyerahan">Penyerahan</label>
                                <input type="date" class="form-control" id="inputPenyerhan" aria-describedby="emailHelp"
                                    name="penyerahan" value="{{ old('penyerahan') ?? $inventaris->tgl_penyerahan }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Asal Dana</label>
                                <select class="my-select form-control" id="exampleFormControlSelect1" name="id_dana">
                                    <option value="{{ old('id_dana') ?? $inventaris->dana->id }}">
                                        {{ old('id_dana') ?? $inventaris->dana->nama }}
                                    </option>
                                    @foreach ($danas as $dana)
                                        @if ($inventaris->dana->id != $dana->id)
                                            <option value="{{ $dana->id }}">{{ $dana->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inputHargaSatuan">Harga Satuan</label>
                                <input name="hrgSatuan" type="number" class="form-control" id="inputHargaSatuan"
                                    aria-describedby="emailHelp" value="{{ old('pembelian') ?? $inventaris->harga }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Bukti Scan Nota</label>
                        <h6 class="text-danger">*masukan file jika ingin merubah nota</h6>
                        <input type="file" class="form-control-file mb-2" id="exampleFormControlFile1" name="file"
                            value="{{ old('file') ?? $inventaris->file }}">
                        <embed src="{{asset('/storage/files/'.$inventaris->file) }} " type="application/pdf" width="400px" height="500px" />
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
