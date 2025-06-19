<x-admin-layout>
    <div class="container-fluid py-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Tabel Kategori --}}
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white" style="font-size: 15px;">
                Daftar Kategori
            </div>
            <div class="card-body bg-light">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle" style="font-size: 15px;">
                        <thead class="table-primary">
                            <tr>
                                <th style="width: 5%;">ID</th>
                                <th style="width: 65%;">Kategori Barang</th>
                                <th style="width: 30%;">Pengaturan</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $data->id }}</td>
                                <td class="text-capitalize">{{ $data->kategori_produk }}</td>
                                <td>
                                    <div class="d-flex justify-content-center  gap-2 flex-wrap">
                                        <form action="{{ route('updateKategori') }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                            style="display: flex; justify-content:center; align-items: center">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                            <input type="text" name="kategori_produk"
                                                class="form-control form-control-sm" placeholder="Nama kategori"
                                                style="max-width: 150px; font-size: 14px; padding: 4px 8px;">
                                            <button type="submit" class="btn btn-outline-danger"
                                                style="font-size: 15px;">
                                                <i class="typcn typcn-delete-outline"></i> Edit
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
