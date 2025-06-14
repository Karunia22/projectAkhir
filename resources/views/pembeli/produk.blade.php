@extends('tampilan.app')
@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shop Category page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Fashon Category</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>


    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-5">
                <div class="sidebar-categories">
                    <div class="head"><a href="{{ route('produkPembeli') }}"
                            style="color:white; font-size:20px">Kategori</a></div>
                    <ul class="main-categories">
                        @foreach ($kategori as $kt)
                            <li class="main-nav-list"><a
                                    href="{{ route('produkPembeliDariKategori', [$kt->id]) }}">{{ $kt->kategori_produk }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-7">
                <!-- Start Best Seller -->
                <section class="lattest-product-area pb-40 category-list">
                    <div class="filter-bar d-flex flex-wrap align-items-center" style="color:white; font-size:20px; padding-top: 10px">
                        <p>Produk Kami</p>
                    </div>
                    <div class="row">
                        <!-- single product -->
                        @forelse ($produk as $pr)
                            <div class="col-lg-4 col-md-6">
                                <a class="single-product" href="/pembeli/detailProduk/{{ $pr->id }}">
                                    <img class="img-fluid" src="{{ asset($pr->img_url) }}" alt=""
                                        style="width: 200px; height: 200px">
                                    <div class="product-details">
                                        <h6>{{ $pr->nama_produk }}</h6>
                                        <div class="price">
                                            <h6>Rp{{ $pr->harga }}</h6>
                                        </div>
                                        <p><strong style="color: black">Stok: {{ $pr->stok }}</strong></h6>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p class="ml-3">Produk tidak ditemukan.</p>
                        @endforelse
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
