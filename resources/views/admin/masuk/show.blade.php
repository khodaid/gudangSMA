<div class="form-group">
    <label for="exampleFormControlSelect1">Barang</label>
    <input name="barang" type="text" class="form-control" id="inputToko" aria-describedby="emailHelp"
        value="{{ old('barang') ?? $masuk->barang->nama }}" disabled>
</div>
<div class="form-group">
    <label for="inputDskripsi">Deskripsi</label>
    <textarea class="form-control" id="inputDeskripsi" rows="3" name="deskripsi"
        disabled>{{ old('deskripsi') ?? $masuk->deskripsi }}</textarea>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="inputQuantity">Jumlah</label>
            <input name="quantity" type="number" class="form-control" id="inputNama" aria-describedby="emailHelp"
                value="{{ old('quantity') ?? $masuk->jumlah }}" disabled>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Satuan</label>
            <input name="satuan" type="text" class="form-control" id="inputToko" aria-describedby="emailHelp"
                value="{{ old('satuan') ?? $masuk->satuan->nama }}" disabled>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="inputToko">Nama Toko</label>
    <input name="toko" type="text" class="form-control" id="inputToko" aria-describedby="emailHelp"
        value="{{ old('toko') ?? $masuk->nama_toko }}" disabled>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="inputPembelian">Pembelian</label>
            <input type="date" class="form-control" id="inputPembelian" aria-describedby="emailHelp" name="pembelian"
                value="{{ old('pembelian') ?? $masuk->tgl_pemesanan }}" disabled>
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="inputPenyerahan">Penyerahan</label>
            <input type="date" class="form-control" id="inputPenyerhan" aria-describedby="emailHelp" name="penyerahan"
                value="{{ old('penyerahan') ?? $masuk->tgl_penerimaan }}" disabled>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="inputHargaSatuan">Harga Satuan</label>
            <input name="hrgSatuan" type="text" class="form-control" id="inputHargaSatuan"
                aria-describedby="emailHelp" value="Rp.{{ old('hrgSatuan') ?? number_format($masuk->harga_satuan) }}"
                disabled>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="inputTotal">Harga Total</label>
            <input name="hrgTotal" type="text" class="form-control" id="inputTotal" aria-describedby="emailHelp"
                value="Rp.{{ old('hrgTotal') ?? number_format($masuk->jumlah_harga) }}" disabled>
        </div>
    </div>
</div>
