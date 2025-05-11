<x-admin-layout>

    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Kategori </h4>

                    <form class="forms-sample" action="{{ route('updateKategori', [$data->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="#">Id</label>
                            <input type="text" class="form-control" name="id" value="{{ $data->id }}">
                            <label for="#">Kategori</label>
                            <input type="text" class="form-control" name="kategori_produk"
                                value="{{ $data->kategori_produk }}">
                        </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">Edit</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
