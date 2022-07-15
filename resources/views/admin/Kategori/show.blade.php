<div class="form-group">
    <label for="inputNama">Nama Lokasi</label>
    {{-- <input name="nama" type="text" class="form-control" id="disabledInput" aria-describedby="emailHelp" value="{{old('nama') ?? $satuan->nama}}"> --}}
    <input class="form-control" id="disabledInput" type="text" placeholder="{{$lokasi->nama}}" disabled>
</div>
<div class="form-group">
    <label for="inputDskripsi">Deskripsi</label>
    <textarea class="form-control" id="inputDeskripsi" rows="3" name="deskripsi" placeholder="{{$lokasi->deskripsi}}" disabled></textarea>
</div>
