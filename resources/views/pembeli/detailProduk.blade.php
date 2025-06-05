@extends('tampilan.app')
@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Product Details Page</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">product-details</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <div class="product_image_area">
        <div class="container">
            @foreach ($produk as $pr)
                @if ($pr->id == $id)
                    <div class="row s_product_inner">
                        <div class="col-lg-6" style="border: 1px solid orange">
                            <img class="img-fluid" src="{{ asset($pr->img_url) }}" alt="" style="height: 100%;width:100%">
                        </div>
                        <div class="col-lg-5 offset-lg-1">
                            <div class="s_product_text">
                                <h3>{{ $pr->nama_produk }}</h3>
                                <h2>Rp{{ $pr->harga }}</h2>
                                <p><b>Deskripsi:</b> {{ $pr->deskripsi }}</p>
                                <h6>Stok: {{ $pr->stok }}</h6>
                                <div class="product_count">
                                    <label for="qty">Quantity:</label>
                                    <input type="text" name="qty" id="sst" maxlength="12" value="1"
                                        title="Quantity:" class="input-text qty">
                                    <button
                                        onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                        class="increase items-count" type="button"><i
                                            class="lnr lnr-chevron-up"></i></button>
                                    <button
                                        onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                        class="reduced items-count" type="button"><i
                                            class="lnr lnr-chevron-down"></i></button>
                                </div>
                                <div class="card_area d-flex align-items-center">
                                    <a class="primary-btn" href="#">Add to Cart</a>
                                    <a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
                                    <a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
                                </div>
                            </div>
                        </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
