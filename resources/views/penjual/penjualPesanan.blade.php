<x-penjual-layout>
    {{-- <a href="{{ route('tambahProduk') }}" class="btn btn-success ms-5">Tambah</a> --}}
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-6 grid-margin stretch-card flex-column"></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive pt-3">
                        <h4>Data Pesanan Pelanggan</h4>
                        <table class="table table-striped project-orders-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Total Harga</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status</th>
                                    <th>Update Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pesanan as $index => $item)
                                    @foreach ($item->pesananKeDetailPesanan as $detail)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->pesananKeUser->name }}</td>
                                            <td>{{ $detail->detailPesananKeProduk->nama_produk }}</td>
                                            <td>{{ $detail->jumlah ?? '-' }}</td>
                                            <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                            <td>{{ ucfirst($item->metode_pembayaran) }}</td>
                                            <td>
                                                <span class="badge bg-warning text-white">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('updateStatusPesanan', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="d-flex align-items-center">
                                                        <select name="status" class="form-select form-select-sm me-2">
                                                            <option value="pending"
                                                                {{ $item->status == 'pending' }}>
                                                                Pending</option>
                                                            <option value="paid"
                                                                {{ $item->status == 'paid'}}>Paid
                                                            </option>
                                                            <option value="shipped"
                                                                {{ $item->status == 'shipped'}}>
                                                                Shipped</option>
                                                        </select>
                                                        <button type="submit"
                                                            class="btn btn-primary btn-sm">Update</button>
                                                    </div>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="7">Tidak ada pesanan ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-penjual-layout>
