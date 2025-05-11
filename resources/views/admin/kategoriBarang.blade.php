<x-admin-layout>
    <a href="{{ route('tambahKategori') }}" class="btn btn-success ms-5">Tambah</a>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-6 grid-margin stretch-card flex-column">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive pt-3">
                        <h4>Kategori</h4>
                        <table class="table table-striped project-orders-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Kategori Barang</th>
                                    <th>Setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->kategori_produk }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="/admin/kategori/editKategori/{{ $d->id }}" class="btn btn-success btn-sm btn-icon-text me-3">
                                                    Edit
                                                    <i class="typcn typcn-edit btn-icon-append"></i>
                                                </a>
                                                <form action="" method="POST"
                                                    onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="button" href="/admin/kategori/hapusKategori/{{ $d->id }}"
                                                        class="btn btn-danger btn-sm btn-icon-text">
                                                        Hapus
                                                    <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                    </a>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
