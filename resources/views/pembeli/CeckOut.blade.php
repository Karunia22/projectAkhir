@extends('tampilan.app')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ url('/') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Buat Pesanan</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout_area section_gap">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-warning alert-dismissible fade show fade-out" role="alert"
                    style="font-size: 15px;">
                    {{ session('success') }}
                </div>
            @endif
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Informasi Pesanan</h3>
                        <div class="info-box">
                            <p><strong>ID Pesanan:</strong> {{ $pesanan->id }}</p>
                            <p><strong>Alamat Pengiriman:</strong> {{ $pesanan->alamat_pengiriman ?? '-' }}</p>
                            <p><strong>Kode Pos:</strong> {{ $pesanan->kode_pos }}</p>
                            <p><strong>Kota:</strong> {{ $pesanan->kota }}</p>
                            <p><strong>Metode Pembayaran:</strong> {{ strtoupper($pesanan->metode_pembayaran) }}</p>
                            <p><strong>No. Telepon:</strong> {{ $pesanan->no_telepon }}</p>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Pesanan Anda</h2>
                            <div class="card-body">
                                @php
                                    $grandTotal = 0;
                                @endphp

                                <ul class="list">
                                    <li><a href="#">Produk <span>Total</span></a></li>
                                    @foreach ($pesanan->pesananKeDetailPesanan as $detail)
                                        @php
                                            $produk = $detail->detailPesananKeProduk;
                                            $total = $detail->total_harga;
                                            $grandTotal += $total;
                                        @endphp
                                        <li>
                                            <a href="#">
                                                {{ $produk->nama_produk ?? 'Produk Tidak Ditemukan' }}
                                                <span class="middle">x {{ $detail->jumlah }}</span>
                                                <span class="last">Rp{{ number_format($total) }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="list list_2">
                                    <li><a href="#">Subtotal <span>Rp{{ number_format($grandTotal) }}</span></a></li>
                                    <li><a href="#">Total <span>Rp{{ number_format($grandTotal) }}</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .info-box {
            width: 100%;
            max-width: 500px;
            margin-bottom: 10px;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            font-family: 'Segoe UI', sans-serif;
            color: #333;
            font-size: 15px;
        }

        .info-box p {
            margin: 5px 0;
        }
    </style>
@endsection
