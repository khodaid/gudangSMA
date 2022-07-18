<div class="form-group">
    <label for="inputNama">Nama Pengambil</label>
    <input class="form-control" id="disabledInput" type="text" value="{{$pengambil->nama}}" disabled>
</div>
<div class="form-group">
    <label for="inputKode">Jabatan</label>
    <input name="jabatan" type="text" class="form-control" id="inputKode" aria-describedby="emailHelp"
        value="{{ old('jabatan') ?? $pengambil->jabatan }}" disabled>
</div>
