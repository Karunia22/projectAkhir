<x-admin-layout>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card shadow">
                    <div class="card-body" style="font-size: 15px;">
                        <h4 class="card-title mb-4">Tambah Produk</h4>

                        <form action="{{ route('terimaInputProduk') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" id="nama_produk" class="form-control" name="nama_produk" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input type="text" id="deskripsi" class="form-control" name="deskripsi" required>
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" id="harga" class="form-control" name="harga" required>
                            </div>

                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" id="stok" class="form-control" name="stok" required>
                            </div>

                            <div class="mb-4">
                                <label for="kategori_id" class="form-label">Kategori Produk</label>
                                <select name="kategori_id" id="kategori_id"
                                    class="form-select form-select-lg p-3 border-2 border-primary shadow rounded-3 fw-semibold text-dark w-100"
                                    style="max-width: 100%;">
                                    <option value="" disabled selected>-- Pilih Kategori Produk --</option>
                                    @foreach ($data as $k)
                                        <option value="{{ $k->id }}">{{ $k->kategori_produk }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="img_url" class="form-label">Gambar</label>
                                <input type="file" id="img_url" class="form-control" name="img_url">
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
