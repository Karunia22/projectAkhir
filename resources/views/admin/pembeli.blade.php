<x-admin-layout>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0" style="font-size: 15px;">Daftar Pembeli</h4>
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
                                {{-- <th>Password</th> --}}
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
                                    {{-- <td>{{ $d->password }}</td> --}}
                                    <td>
                                        <span class="badge bg-success text-white">
                                            {{ ucfirst($d->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ url('/admin/pembeli/hapusPembeli/' . $d->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                style="font-size: 15px;">
                                                <i class="typcn typcn-delete-outline"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data pembeli.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
