<x-admin-layout>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card shadow">
                    <div class="card-body" style="font-size: 15px;">
                        <h4 class="card-title mb-4">Edit Produk</h4>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
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
                        <form class="forms-sample" action="{{ route('updateProduk', [$data->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="nama_produk"
                                    value="{{ $data->nama_produk }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" name="deskripsi"
                                    value="{{ $data->deskripsi }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga" value="{{ $data->harga }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stok" value="{{ $data->stok }}"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="kategori_id" class="form-label">Kategori Produk</label>
                                <select name="kategori_id" class="form-select" required>
                                    <option value="" disabled>-- Pilih Kategori Produk --</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}"
                                            {{ $data->kategori_id == $k->id ? 'selected' : '' }}>
                                            {{ $k->kategori_produk }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="img_url" class="form-label">Gambar Produk</label>
                                <input type="file" class="form-control" name="img_url">
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
