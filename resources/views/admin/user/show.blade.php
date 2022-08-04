<div class="form-group">
    <label for="inputNama">Nama User</label>
    {{-- <input name="nama" type="text" class="form-control" id="disabledInput" aria-describedby="emailHelp" value="{{old('nama') ?? $satuan->nama}}"> --}}
    <input class="form-control" id="disabledInput" type="text" placeholder="{{$user->name}}" disabled>
</div>
<div class="form-group">
    <label for="inputNama">Email</label>
    {{-- <input name="nama" type="text" class="form-control" id="disabledInput" aria-describedby="emailHelp" value="{{old('nama') ?? $satuan->nama}}"> --}}
    <input class="form-control" id="disabledInput" type="text" placeholder="{{$user->email}}" disabled>
</div>
