<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="{{ route('pembeliBeranda') }}">Home</a>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('produkPembeli') }}">Shop
                                        Category</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{-- {{ route('detailProdukPembeli') }} --}}">Product Details</a></li>
                                </li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('detailPesanan') }}">Confirmation</a>
                                </li>
                            </ul>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                <li class="nav-item"><a class="nav-link" href="{{ route('pembeliProfil') }}">Profil</a></li>
                            @else
                                <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">Login</a></li>
                                @if (Route::has('register'))
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/register') }}">Register</a></li>
                                @endif
                            @endauth
                        @endif
                        <li class="nav-item"><a class="nav-link" href="{{ route('daftarPesanan') }}">Pesananku</a>
                        <li class="nav-item"><a class="nav-link" href="{{ route('keranjangPembeli') }}">Keranjang</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('permintaanServis') }}">Permintaan
                                Servis</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between">
                <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>
