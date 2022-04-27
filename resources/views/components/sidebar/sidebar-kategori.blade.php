<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBarang"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Kategori</span>
    </a>
    <div id="collapseBarang" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Kategori</h6>
            @if (!isset(Auth::user()->id_super))
            <a class="collapse-item" href="{{route('satuan.index')}}">Satuan Barang</a>
            @endif
            <a class="collapse-item" href="{{route('barang.index')}}">Barang</a>
            <a class="collapse-item" href="{{route('dana.index')}}">Asal Dana</a>
        </div>
    </div>
</li>