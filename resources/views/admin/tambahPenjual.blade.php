<x-admin-layout>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card shadow">
                    <div class="card-body" style="font-size: 15px;">
                        <h4 class="card-title mb-4">Tambah Penjual</h4>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="forms-sample" action="{{ route('terimaInputPenjual') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" required
                                    placeholder="Nama Lengkap">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" required
                                    placeholder="contoh@email.com">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required
                                    placeholder="Minimal 8 karakter">
                            </div>
                            <div class="form-group">
                                <label for="no_telepon">Nomor HP Penjual</label>
                                <input type="text" class="form-control" id="no_telepon" name="no_telepon"
                                    placeholder="Contoh: 08123456789" required>
                            </div>
                            <input type="hidden" name="role" value="penjual">

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" style="font-size: 15px;">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
