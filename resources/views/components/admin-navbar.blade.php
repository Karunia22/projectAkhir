<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sperpate Rider</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('adminBeranda') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('kategori') }}" aria-expanded="true" aria-controls="collapseTwo">
            <span>Kategori Produk</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('penjual') }}" data-target="#collapseUtilities" aria-expanded="true"
            aria-controls="collapseUtilities">
            <span>Penjual</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('pembeli') }}" data-target="#collapseUtilities" aria-expanded="true"
            aria-controls="collapseUtilities">
            <span>Pembeli</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('produk') }}" data-target="#collapseUtilities" aria-expanded="true"
            aria-controls="collapseUtilities">
            <span>Produk</span>
        </a>
    </li>

</ul>