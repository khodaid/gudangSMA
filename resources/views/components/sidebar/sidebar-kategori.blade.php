<li class="nav-item {{request()->is('satuan') ? 'active' : '' }} {{request()->is('barang') ? 'active' : '' }} {{request()->is('dana') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarang"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-th"></i>
        <span>Kategori</span>
    </a>
    <div id="collapseBarang" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kategori</h6>
            @if (!isset(Auth::user()->id_super))
            <a class="collapse-item" href="{{route('satuan.index')}}">Satuan Barang</a>
            <a class="collapse-item" href="{{route('kategori.index')}}">Kategori Barang</a>
            <a class="collapse-item" href="{{route('lokasi.index')}}">Lokasi</a>
            @endif
            <a class="collapse-item" href="{{route('barang.index')}}">Barang</a>
            <a class="collapse-item" href="{{route('pengambil.index')}}">Pengambil</a>
            <a class="collapse-item" href="{{route('dana.index')}}">Asal Dana</a>
        </div>
    </div>
</li>
