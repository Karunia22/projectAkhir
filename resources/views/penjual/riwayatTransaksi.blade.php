<x-penjual-layout>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Riwayat Transaksi (Shipped Saja)</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            @if($item->detailPesananKePesanan && $item->detailPesananKePesanan->status == 'shipped')
                                <tr>
                                    <td>{{ $item->detailPesananKeProduk->nama_produk ?? '-' }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td><span class="badge bg-success">Shipped</span></td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-penjual-layout>