<x-admin-layout>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0" style="font-size: 15px;">Daftar Penjual</h4>
            <a href="{{ route('tambahPenjual') }}" class="btn btn-success" style="font-size: 15px;">
                Tambah Penjual
            </a>
        </div>

        <div class="card shadow border-0">
            <div class="card-body" style="font-size: 15px;">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $d)
                                <tr>
                                    <td>{{ $d->id }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>
                                        <span class="badge bg-primary text-white">{{ ucfirst($d->role) }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ url('/admin/penjual/editPenjual/' . $d->id) }}"
                                                class="btn btn-sm btn-warning text-white" style="font-size: 15px;">
                                                <i class="typcn typcn-edit"></i> Edit
                                            </a>

                                            <a href="{{ route('hapusPenjual', $d->id) }}" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus penjual ini?')">
                                                Hapus
                                            </a>
                                        </div>

                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data penjual.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
