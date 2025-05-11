<x-admin-layout>

    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Kategori </h4>

                    <form class="forms-sample" action="{{ route('terimaInputKategori') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="credits">Kategori</label>
                            <input type="text" class="form-control" name="kategori_produk">
                        </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
