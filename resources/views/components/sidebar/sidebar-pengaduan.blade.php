<li class="nav-item {{request()->is('pengaduan') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengaduan"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-desktop"></i>
        <span>Pengaduan</span>
    </a>
    <div id="collapsePengaduan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Pengaduan</h6>
            <a class="collapse-item" href="{{route('pengaduan.index')}}">Kerusakan</a>
        </div>
    </div>
</li>
