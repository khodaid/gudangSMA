<li class="nav-item {{request()->is('user') ? 'active' : '' }}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-users"></i>
        <span>Kelola User</span>
    </a>
    <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">User</h6>
            <a class="collapse-item" href="{{route('user.index')}}">User</a>
        </div>
    </div>
</li>
