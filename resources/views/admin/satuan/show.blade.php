<div class="form-group">
    <label for="inputNama">Nama Satuan</label>
    {{-- <input name="nama" type="text" class="form-control" id="disabledInput" aria-describedby="emailHelp" value="{{old('nama') ?? $satuan->nama}}"> --}}
    <input class="form-control" id="disabledInput" type="text" placeholder="{{$satuan->nama}}" disabled>
</div>
