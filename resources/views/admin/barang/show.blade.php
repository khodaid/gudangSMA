<div class="form-group">
    <label for="inputNama">Nama Barang</label>
    {{-- <input name="nama" type="text" class="form-control" id="disabledInput" aria-describedby="emailHelp" value="{{old('nama') ?? $satuan->nama}}"> --}}
    <input class="form-control" id="disabledInput" type="text" value="{{$barang->nama}}" disabled>
</div>
<div class="form-group">
    <label for="inputJumlah">Nama Jumlah</label>
    {{-- <input name="nama" type="text" class="form-control" id="disabledInput" aria-describedby="emailHelp" value="{{old('nama') ?? $satuan->nama}}"> --}}
    <input class="form-control" id="disabledInput" type="text" value="{{$jumlah}}" disabled>
</div>
