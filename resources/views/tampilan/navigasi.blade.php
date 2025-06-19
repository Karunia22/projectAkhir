<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="{{ route('pembeliBeranda') }}">
                    <img src="{{ asset('gambar/logo/ChatGPT Image May 6, 2025, 11_21_36 PM.png') }}" alt="" style="width: 80px; height: 80px">
                </a>

                <!-- Navigation links -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item {{ request()->routeIs('pembeliBeranda') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pembeliBeranda') }}">Beranda</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('produkPembeli') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('produkPembeli') }}">Kategori</a>
                        </li>

                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item {{ request()->routeIs('pembeliProfil') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('pembeliProfil') }}">Profil</a>
                                </li>
                            @else
                                <li class="nav-item {{ request()->is('login') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ url('/login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item {{ request()->is('register') ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ url('/register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif

                        <li class="nav-item {{ request()->routeIs('daftarPesanan') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('daftarPesanan') }}">Pesananku</a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('keranjangPembeli') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('keranjangPembeli') }}">Keranjang</a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>
    </div>
</header>
