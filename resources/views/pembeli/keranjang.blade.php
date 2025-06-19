@extends('tampilan.app')
@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Keranjang</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Keranjang</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="cart_area">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-warning alert-dismissible fade show fade-out" role="alert"
                    style="font-size: 15px;">
                    {{ session('success') }}
                </div>
            @endif
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
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead style="border-bottom: 1px solid rgb(240, 240, 240)">
                            <tr>
                                <th scope="col"> Ceklis</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{ route('cekOutKeranjang') }}" method="POST">
                                @csrf
                                @forelse ($keranjang as $item)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="indexKeranjang[]" value="{{ $item->id }}">
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="d-flex">
                                                    <img src="{{ asset($item->keranjangKeProduk->img_url) }}" alt=""
                                                        style="width: 100px; height: 100px;">
                                                </div>
                                                <div class="media-body">
                                                    <p>{{ $item->keranjangKeProduk->nama_produk }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h5>{{ $item->keranjangKeProduk->stok }}</h5>
                                        </td>
                                        <td>
                                            <h5> {{ $item->jumlah }} </h5>
                                        </td>
                                        <td>
                                            <h5>Rp{{ $item->keranjangKeProduk->harga }}</h5>
                                        </td>
                                        <td>
                                            <h5>Rp{{ $item->keranjangKeProduk->harga * $item->jumlah }}</h5>
                                        </td>
                                        <td style="width: 200px">
                                            <div class="card_area d-flex align-items-center">
                                                <a href="{{ route('hapusKeranjang', ['id' => $item->id]) }}"
                                                    class="primary-btn" style="width: 100px"> Hapus</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="ml-3" style="text-align: center">Produk tidak ditambahkan di keranjang
                                        </td>
                                    </tr>
                                @endforelse
                                <button class="primary-btn" style="width: 100px; border-radius:5px;">Beli</button>
                                <select name="metode_pembayaran">
                                    <option value="">Pilih metode pembayaran</option>
                                    <option value="COD">COD</option>
                                </select>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
