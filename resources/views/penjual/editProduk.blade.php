<x-penjual-layout>

    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <form class="forms-sample" action="{{ route('updateProdukPenjual',[$data->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="credits">Nama produk</label>
                            <input type="text" class="form-control" name="nama_produk" value="{{ $data->nama_produk }}">
                        </div>
                        <div class="form-group">
                            <label for="credits">Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" value="{{ $data->deskripsi }}">
                        </div>
                        <div class="form-group">
                            <label for="credits">Harga</label>
                            <input type="number" class="form-control" name="harga" value="{{ $data->harga }}">
                        </div>
                        <div class="form-group">
                            <label for="credits">Stok</label>
                            <input type="number" class="form-control" name="stok" value="{{ $data->stok }}">
                        </div>
                        <div class="form-group">

                            <select name="kategori_id"
                                class="form-select form-select-lg mb-4 p-3 border-2 border-primary shadow rounded-3 fw-semibold text-dark w-100"
                                style="max-width: 600px;">
                                <option value="" disabled selected>-- Pilih Kategori Produk --</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->kategori_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="credits">Gambar</label>
                            <input type="file" class="form-control" name="img_url">
                        </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">Edit</button>
                </form>
            </div>
        </div>
    </div>
</x-penjual-layout>