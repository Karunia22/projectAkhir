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
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show fade-out" role="alert"
                    style="font-size: 15px;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @foreach ($produk as $pr)
                @if ($pr->id == $id)
                    <div class="row s_product_inner">
                        <div class="col-lg-6" style="border: 1px solid orange">
                            <img class="img-fluid" src="{{ asset($pr->img_url) }}" alt=""
                                style="height: 100%;width:100%">
                        </div>
                        <div class="col-lg-5 offset-lg-1">
                            <h3>{{ $pr->nama_produk }}</h3>
                            <h2>Rp{{ $pr->harga }}</h2>
                            <p><b>Deskripsi:</b> {{ $pr->deskripsi }}</p>
                            <h6>Stok: {{ $pr->stok }}</h6>
                            <form class="s_product_text" action="{{ route('cekout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $pr->id }}">
                                <div class="product_count">
                                    <label for="jumlah">Jumlah:</label>
                                    <input type="text" name="jumlah" id="sst" maxlength="12"
                                        class="input-text qty">
                                    
                                </div>
                                <div class="card_area d-flex align-items-center">
                                    <button type="submit" class="primary-btn" {{-- href="{{ route('cekout') }}" --}}>Beli</button>
                                    <select name="metode_pembayaran">
                                        <option value="">Pilih metode pembayaran</option>
                                        <option value="COD">COD</option>
                                    </select>
                                </div>
                            </form>
                            <form class="s_product_text" action="{{ route('isiKeranjangPembeli') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user }}">
                                <input type="hidden" name="produk_id" value="{{ $pr->id }}">
                                <div class="product_count">
                                    <label for="jumlah">Jumlah:</label>
                                    <input type="text" name="jumlah" id="sst" maxlength="12"
                                        class="input-text qty">
                                </div>
                                <div class="card_area d-flex align-items-center">
                                    <button type="submit" class="primary-btn" {{-- href="{{ route('cekout') }}" --}}>Simpan</button>
                                </div>
                            </form>
                        </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
