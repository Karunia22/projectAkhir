<x-penjual-layout>
    <div class="container-fluid py-4">


        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-body" style="font-size: 15px;">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <h4 class="card-title mb-4">Daftar Produk</h4>

                        <div class="table-responsive pt-3">
                            <table class="table table-striped project-orders-table align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Kategori</th>
                                        <th>Gambar</th>
                                        <th>Pengaturan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $d->id }}</td>
                                            <td>{{ $d->nama_produk }}</td>
                                            <td>{{ $d->deskripsi }}</td>
                                            <td>Rp{{ number_format($d->harga, 0, ',', '.') }}</td>
                                            <td>{{ $d->stok }}</td>
                                            <td>{{ $d->produkKeKategori->kategori_produk ?? 'Tidak Ada' }}</td>
                                            <td>
                                                @if ($d->img_url)
                                                    <img src="{{ asset('uploads/' . $d->img_url) }}" alt="gambar produk"
                                                        width="60" class="rounded shadow">
                                                @else
                                                    <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{ route('editProdukPenjual', $d->id) }}"
                                                        class="btn btn-success btn-sm me-2">
                                                        Edit
                                                        <i class="typcn typcn-edit btn-icon-append"></i>
                                                    </a>

                                                    <form action="{{ route('hapusProduk', $d->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            Hapus
                                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @if ($data->isEmpty())
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">Tidak ada produk tersedia.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-penjual-layout>
