<li class="nav-item {{request()->is('masuk') ? 'active' : '' }} {{request()->is('keluar') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Transaksi</span>
    </a>
    <div id="collapseTransaksi" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Transaksi</h6>
            <a class="collapse-item" href="{{route('masuk.index')}}">Barang Masuk</a>
            <a class="collapse-item" href="{{route('keluar.index')}}">Barang Keluar</a>
        </div>
    </div>
</li>
