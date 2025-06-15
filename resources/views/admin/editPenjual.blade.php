<x-admin-layout>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card shadow">
                    <div class="card-body" style="font-size: 15px;">
                        <h4 class="card-title mb-4">Edit Data Penjual</h4>
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
                        <form action="{{ route('updatePenjual', [$data->id]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $data->name }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $data->email }}"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Isi jika ingin ubah password">
                            </div>

                            <input type="hidden" name="role" value="penjual">

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" style="font-size: 15px;">Edit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
