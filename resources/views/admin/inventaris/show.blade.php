<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Barang</label>
            <input name="barang" type="text" class="form-control" id="inputKode" aria-describedby="emailHelp"
                value="{{ old('barang') ?? $inventaris->barang->nama }} " disabled>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="inputKode">Kode</label>
            <input name="kode" type="text" class="form-control" id="inputKode" aria-describedby="emailHelp"
                value="{{ old('kode') ?? $inventaris->kode }} " disabled>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="inputPembukuan">Pembukuan</label>
    <input type="date" class="form-control" id="inputPembukuan" aria-describedby="emailHelp" name="pembukuan"
        value="{{ old('pembukuan') ?? $inventaris->tgl_pembukuan }}" disabled>
</div>
<div class="form-group">
    <label for="inputDskripsi">Deskripsi</label>
    <textarea class="form-control" id="inputDeskripsi" rows="3" name="deskripsi"
        disabled>{{ old('deskripsi') ?? $inventaris->deskripsi }}</textarea>
</div>
{{-- <div class="row"> --}}
    {{-- <div class="col">
        <div class="form-group">
            <label for="inputQuantity">Jumlah</label>
            <input name="jumlah" type="number" class="form-control" id="inputNama" aria-describedby="emailHelp"
                value="{{ old('quantity') ?? $inventaris->jumlah }}" disabled>
        </div>
    </div>
    <div class="col"> --}}
        <div class="form-group">
            <label for="exampleFormControlSelect1">Satuan</label>
            <input name="satuan" type="text" class="form-control" id="inputKode" aria-describedby="emailHelp"
                value="{{ old('satuan') ?? $inventaris->satuan->nama }} " disabled>
        </div>
    {{-- </div> --}}
{{-- </div> --}}
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="inputPembuatan">Tahun Pembuatan</label>
            <input type="text" class="form-control" id="inputPembuatan" aria-describedby="emailHelp" name="pembuatan"
                value="{{ old('pembuatan') ?? $inventaris->thn_pembuatan }}" disabled>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="inputPenyerahan">Tanggal Penyerahan</label>
            <input type="date" class="form-control" id="inputPenyerhan" aria-describedby="emailHelp" name="penyerahan"
                value="{{ old('penyerahan') ?? $inventaris->tgl_penyerahan }}" disabled>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="exampleFormControlSelect1">Lokasi</label>
    <input name="satuan" type="text" class="form-control" id="inputKode" aria-describedby="emailHelp"
        value="{{ old('lokasi') ?? $inventaris->lokasi->nama_lokasi }} " disabled>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Asal Dana</label>
            <input name="dana" type="text" class="form-control" id="inputKode" aria-describedby="emailHelp"
                value="{{ old('dana') ?? $inventaris->dana->nama }} " disabled>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="inputHargaSatuan">Harga Satuan</label>
            <input name="hrgSatuan" type="text" class="form-control" id="inputHargaSatuan"
                aria-describedby="emailHelp" value="Rp.{{ old('pembelian') ?? number_format($inventaris->harga) }}" disabled>
        </div>
    </div>
</div>
