<x-penjual-layout>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive pt-3">
                        <h4>Daftar Pesanan</h4>
                        <table class="table table-striped project-orders-table text-center">
                            <thead class="text-white" style="background-color: orange;">
                                <tr>
                                    <th>No</th>
                                    <th>Alamat Pengiriman</th>
                                    <th>Kota</th>
                                    <th>Kode Pos</th>
                                    <th>No Telepon</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pesanan as $index => $item)
                                    <tr>
                                        {{-- <td>{{ $index + 1 }}</td> --}}
                                        <td>{{ $item->alamat_pengiriman }}</td>
                                        <td>{{ $item->kota }}</td>
                                        <td>{{ $item->kode_pos }}</td>
                                        <td>{{ $item->no_telepon }}</td>
                                        <td>{{ ucfirst($item->metode_pembayaran) }}</td>
                                        <td>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge bg-warning text-white" style="font-size: 15px">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <form action="{{ route('hapusPesanan', ['id' => $item->id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm btn-icon-text">
                                                        Hapus
                                                        <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted">Belum ada pesanan.</td>
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
