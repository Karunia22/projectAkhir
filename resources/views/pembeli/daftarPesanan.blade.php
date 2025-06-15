@extends('tampilan.app')

@section('content')
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Daftar Pesanan</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ url('/') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="#">Pesanan</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="cart_area">
        <div class="container mt-5">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table text-center" style="border: 2px solid orange;">
                        <thead style="background-color: orange; color: white;">
                            <tr>
                                <th>No</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Kode Pos</th>
                                <th>No Telepon</th>
                                <th>Metode</th>
                                <th>Produk</th>
                                <th>Jumlah Barang</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Batal</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesanan as $index => $item)
                                @php
                                    $jumlahBarang = $item->pesananKeDetailPesanan->sum('jumlah') ?? 0;
                                @endphp
                                <tr style="border-bottom: 1px solid orange;">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->alamat_pengiriman }}</td>
                                    <td>{{ $item->kota }}</td>
                                    <td>{{ $item->kode_pos }}</td>
                                    <td>{{ $item->no_telepon }}</td>
                                    <td>{{ ucfirst($item->metode_pembayaran) }}</td>
                                    <td>
                                        <ul style="list-style: none; padding: 0;">
                                            @foreach ($item->pesananKeDetailPesanan as $detail)
                                                <li>
                                                    {{ $detail->detailPesananKeProduk->nama_produk }}
                                                    (x{{ $detail->jumlah }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $jumlahBarang }}</td>
                                    <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge" style="background-color: orange; color: white;">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($item->status == 'paid' || $item->status == 'pending')
                                            <a href="{{ route('batalPesanan', ['id' => $item->id]) }}">
                                                <span class="badge" style="background-color: orange; color: white;">
                                                    Batal
                                                </span>
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->status == 'shipped')
                                            <a href="{{ route('hapusPesanan', ['id' => $item->id]) }}">
                                                <span class="badge" style="background-color: orange; color: white;">
                                                    Hapus
                                                </span>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center text-muted">Belum ada pesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
