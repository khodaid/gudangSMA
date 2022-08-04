<li class="nav-item {{request()->is('inventaris') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventaris"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-desktop"></i>
        <span>Inventaris</span>
    </a>
    <div id="collapseInventaris" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Inventaris</h6>
            <a class="collapse-item" href="{{route('inventaris.index')}}">Inventaris</a>
        </div>
    </div>
</li>
