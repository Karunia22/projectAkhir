<x-admin-layout>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-header bg-primary text-white" style="font-size: 15px;">
                        <h5 class="mb-0">Tambah Kategori</h5>
                    </div>
                    <div class="card-body" style="font-size: 15px;">
                        <form action="{{ route('terimaInputKategori') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="kategori_produk" class="form-label">Kategori</label>
                                <input type="text" class="form-control" name="kategori_produk" id="kategori_produk"
                                    required>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success" style="font-size: 15px;">
                                    <i class="typcn typcn-plus"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
