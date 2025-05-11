<x-admin-layout>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-xl-6 grid-margin stretch-card flex-column">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="table-responsive pt-3">
                        <h4>Pembeli</h4>
                        <table class="table table-striped project-orders-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                    @if ($d->role === 'pembeli')
                                        <tr>
                                            <td>{{ $d->id }}</td>
                                            <td>{{ $d->name }}</td>
                                            <td>{{ $d->email }}</td>
                                            <td>{{ $d->password }}</td>
                                            <td>{{ $d->role }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    
                                                    <form action=" " method="POST"
                                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a type="button"
                                                            href="/admin/pembeli/hapusPembeli/{{ $d->id }}"
                                                            class="btn btn-danger btn-sm btn-icon-text">
                                                            Hapus
                                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                                        </a>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
