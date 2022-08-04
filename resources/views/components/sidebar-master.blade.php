<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <i class="fas fa-people-carry"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Gudangku</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href=" {{ route('dashboard.index') }} ">
            <i class="fa fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manage Barang
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @include('components.sidebar.sidebar-kategori')

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @include('components.sidebar.sidebar-transaksi')

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Inventaris
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @include('components.sidebar.sidebar-inventaris')

    @if (Auth::user()->roles == 2)
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Pengaduan
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        @include('components.sidebar.sidebar-pengaduan')
    @endif

    <!-- Divider -->
    @if (Auth::user()->roles == 1)
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            User
        </div>

        <!-- Nav Item - Pages Collapse Menu -->

        @include('components.sidebar.sidebar-user')
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
