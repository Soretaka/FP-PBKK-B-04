<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{__('book.borrow')}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ ($title === "Dashboard") ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard-index-user') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Buku Teratas</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>

    <!-- Nav Item - Menu Utama-->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#menu"
            aria-expanded="true" aria-controls="menu">
            <i class="fas fa-fw fa-folder"></i>
            <span>{{__('layout.menu')}}</span>
        </a>
        <div id="menu" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">{{__('layout.profile')}}:</h6>
                <a class="collapse-item {{ ($title === "Book") ? 'active' : '' }}" href="{{ route('book.index') }}">Data Buku</a>
                <a class="collapse-item {{ ($title === "Book") ? 'active' : '' }}" href="{{ route('borrow.index') }}">Peminjaman</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pengaturan Akun -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-cog"></i>
            <span>{{__('layout.settings')}}</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->