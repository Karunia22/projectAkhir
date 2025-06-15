@extends('tampilan.app')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Buat Pesanan</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Produk</h3>
                        <div
                            style="width: 100%; max-width: 500px; margin-bottom: 10px; padding: 10px 15px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); font-family: 'Segoe UI', sans-serif;">
                            <p style="margin: 0; color: #333; font-size: 15px;"><strong style="color: #555;">ID
                                    Pesanan:</strong> {{ $pesanan->id }}</p>
                        </div>

                        <div
                            style="width: 100%; max-width: 500px; margin-bottom: 10px; padding: 10px 15px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); font-family: 'Segoe UI', sans-serif;">
                            <p style="margin: 0; color: #333; font-size: 15px;"><strong style="color: #555;">Total
                                    Harga:</strong> Rp{{ number_format($pesanan->total_harga) }}</p>
                        </div>

                        <div
                            style="width: 100%; max-width: 500px; margin-bottom: 10px; padding: 10px 15px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); font-family: 'Segoe UI', sans-serif;">
                            <p style="margin: 0; color: #333; font-size: 15px;"><strong style="color: #555;">Alamat
                                    Pengiriman:</strong> {{ $pesanan->alamat_pengiriman ?? '-' }}</p>
                        </div>

                        <div
                            style="width: 100%; max-width: 500px; margin-bottom: 10px; padding: 10px 15px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); font-family: 'Segoe UI', sans-serif;">
                            <p style="margin: 0; color: #333; font-size: 15px;"><strong style="color: #555;">Kode
                                    Pos:</strong> {{ $pesanan->kode_pos }}</p>
                        </div>

                        <div
                            style="width: 100%; max-width: 500px; margin-bottom: 10px; padding: 10px 15px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); font-family: 'Segoe UI', sans-serif;">
                            <p style="margin: 0; color: #333; font-size: 15px;"><strong style="color: #555;">Kota:</strong>
                                {{ $pesanan->kota }}</p>
                        </div>

                        <div
                            style="width: 100%; max-width: 500px; margin-bottom: 10px; padding: 10px 15px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); font-family: 'Segoe UI', sans-serif;">
                            <p style="margin: 0; color: #333; font-size: 15px;"><strong style="color: #555;">Metode
                                    Pembayaran:</strong> {{ strtoupper($pesanan->metode_pembayaran) }}</p>
                        </div>

                        <div
                            style="width: 100%; max-width: 500px; margin-bottom: 10px; padding: 10px 15px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); font-family: 'Segoe UI', sans-serif;">
                            <p style="margin: 0; color: #333; font-size: 15px;"><strong style="color: #555;">No.
                                    Telepon:</strong> {{ $pesanan->no_telepon }}</p>
                        </div>

                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <div class="card-body">
                                @php
                                    $detail = $pesanan->pesananKeDetailPesanan->first();
                                    $produk = $detail->detailPesananKeProduk;
                                    $hargaSatuan = $produk->harga ?? 0;
                                    $jumlah = $detail->jumlah;
                                    $total = $detail->total_harga;
                                    $grandTotal = $total;
                                @endphp

                                <ul class="list">
                                    <li><a href="#">Produk <span>Total</span></a></li>
                                    <li>
                                        <a href="#">{{ $produk->nama_produk ?? 'Produk Tidak Ditemukan' }}
                                            <span class="middle">x {{ $jumlah }}</span>
                                            <span class="last">Rp{{ number_format($total) }}</span>
                                        </a>
                                    </li>
                                </ul>

                                <ul class="list list_2">
                                    <li><a href="#">Subtotal <span>Rp{{ number_format($total) }}</span></a></li>
                                    </li>
                                    <li><a href="#">Total <span>Rp{{ number_format($grandTotal) }}</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
