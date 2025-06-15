<x-admin-layout>
    <div class="container-fluid py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 25px;">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary" style="font-size: 25px;">Manajemen Kategori Produk</h2>
            <a href="{{ route('tambahKategori') }}" class="btn btn-primary shadow" style="font-size: 25px;">
                <i class="typcn typcn-plus"></i> Tambah Kategori
            </a>
        </div>

        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0" style="font-size: 25px;">Daftar Kategori</h5>
            </div>
            <div class="card-body bg-light">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle" style="font-size: 25px;">
                        <thead class="table-primary">
                            <tr>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 65%;">Kategori Barang</th>
                                <th style="width: 30%;">Pengaturan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $d)
                                <tr>
                                    <td>{{ $d->id }}</td> <!-- ID tanpa latar belakang -->
                                    <td class="text-capitalize">{{ $d->kategori_produk }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <a href="/admin/kategori/editKategori/{{ $d->id }}"
                                                class="btn btn-sm btn-outline-primary" style="font-size: 25px;">
                                                <i class="typcn typcn-edit"></i> Edit
                                            </a>
                                            <form action="/admin/kategori/hapusKategori/{{ $d->id }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    style="font-size: 25px;">
                                                    <i class="typcn typcn-delete-outline"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">Belum ada kategori tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
