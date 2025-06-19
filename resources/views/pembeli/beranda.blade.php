@extends('tampilan.app')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Beranda</h1>
                    <nav class="d-flex align-items-center">
                        <div style="color: white">Home<span class=""></span></div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="container" style="margin-top:30px ">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Produk</h1>
                    <p>Berikut adalah beberapa produk Kami</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($produk as $pr)
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" src="{{ asset($pr->img_url) }}" alt=""
                            style="border: 1px solid rgb(142, 90, 224); width: 200px; height: 200px">
                        <div class="product-details">
                            <h6>{{ $pr->nama_produk }}</h6>
                            <h7 style="color: black; font-weight: 400">Deskripsi</h7>
                            <p>
                                {{ $pr->deskripsi }}
                            </p>
                            <div class="price">
                                <h6>Rp{{ $pr->harga }}</h6>
                            </div>
                            <div class="prd-bottom">

                                <a href="" class="social-info">
                                    <span class="ti-bag"></span>
                                    <p class="hover-text">Keranjang</p>
                                </a>
                                <a href="/pembeli/detailProduk/{{ $pr->id }}" class="social-info">
                                    <span class="lnr lnr-move"></span>
                                    <p class="hover-text">Lihat</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
