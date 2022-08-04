<div class="form-group">
    <label for="nomerPengadudan">Nomer Pengaduan</label>
    <input class="form-control" id="disabledInput" type="text" placeholder="{{ $pengaduan->nomer_pengaduan }}" disabled>
</div>
<div class="form-group">
    <label for="nama">Nama Pelapor</label>
    <input class="form-control" id="disabledInput" type="text" placeholder="{{ $pengaduan->name }}" disabled>
</div>
<div class="form-group">
    <label for="departement">Departemen</label>
    <input class="form-control" id="disabledInput" type="text" placeholder="{{ $pengaduan->departement }}" disabled>
</div>
<div class="form-group">
    <label for="barang">Nama Barang</label>
    <input class="form-control" id="disabledInput" type="text" placeholder="{{ $pengaduan->barang }}" disabled>
</div>
<div class="form-group">
    <label for="status">Status Pengaduan</label>
    @if ($pengaduan->status == 1)
        <input class="form-control" id="disabledInput" type="text" placeholder="Rusak" disabled>
    @elseif ($pengaduan->status == 2)
        <input class="form-control" id="disabledInput" type="text" placeholder="Perbaikan" disabled>
    @else
        <input class="form-control" id="disabledInput" type="text" placeholder="Selesai" disabled>
    @endif
</div>
<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea class="form-control" id="inputDeskripsi" rows="3" name="deskripsi" placeholder="{{ $pengaduan->description }}"
        disabled></textarea>
</div>
<div class="form-group">
    <label for="lokasi">Lokasi</label>
    <input class="form-control" id="disabledInput" type="text" placeholder="{{ $pengaduan->location }}"
        disabled>
</div>
