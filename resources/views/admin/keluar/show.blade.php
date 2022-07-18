<div class="form-group">
    <label for="inputBarang">Barang</label>
    <input class="form-control" id="disabledInput" type="text" placeholder="{{$keluar->barang->nama}}" disabled>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="inputJumlah">Jumlah</label>
            <input class="form-control" id="disabledInput" type="text" placeholder="{{$keluar->jumlah}}" disabled>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="inputSatuan">Satuan</label>
            <input class="form-control" id="disabledInput" type="text" placeholder="{{$keluar->satuan->nama}}" disabled>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="inputTanggal">Pengambil</label>
    <input class="form-control" id="disabledInput" type="text" placeholder={{$keluar->pengambil->nama}} disabled>
</div>
<div class="form-group">
    <label for="inputTanggal">Tanggal</label>
    <input class="form-control" id="disabledInput" type="text" placeholder="{{date('d-m-Y', strtotime($keluar->tgl_keluar))}}" disabled>
</div>
<div class="form-group">
    <label for="inputDskripsi">Deskripsi</label>
    <textarea class="form-control" id="inputDeskripsi" rows="3" name="deskripsi" placeholder="{{$keluar->deskripsi}}" disabled></textarea>
</div>
