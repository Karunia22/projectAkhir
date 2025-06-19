<x-penjual-layout>
    <div class="row justify-content-center">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card shadow rounded">
                <div class="card-body">

                    <h4 class="card-title mb-4">Edit Data Produk</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form class="row g-3" action="{{ route('updateProdukPenjual', [$data->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="col-md-6">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control"
                                value="{{ old('nama_produk', $data->nama_produk) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" name="harga" class="form-control"
                                value="{{ old('harga', $data->harga) }}" required>
                        </div>

                        <div class="col-md-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $data->deskripsi) }}</textarea>
                        </div>

                        <div class="col-md-6">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" name="stok" class="form-control"
                                value="{{ old('stok', $data->stok) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="img_url" class="form-label">Gambar Produk</label>
                            <input type="file" name="img_url" class="form-control">
                        </div>

                        @if ($data->img_url)
                            <div class="col-md-12 mt-3">
                                <label class="form-label d-block">Gambar Saat Ini:</label>
                                <img src="{{ asset('uploads/' . $data->img_url) }}" width="150"
                                    class="img-thumbnail shadow-sm">
                            </div>
                        @endif

                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-penjual-layout>
