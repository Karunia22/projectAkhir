<x-admin-layout>

    <div class="row">

        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Penjual </h4>
                    <form class="forms-sample" action="{{ route('updatePenjual',[$data->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="credits">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                        </div>
                        <div class="form-group">
                            <label for="credits">Email</label>
                            <input type="email" class="form-control" name="email"  value="{{ $data->email }}">
                        </div>
                        <div class="form-group">
                            <label for="credits">Password</label>
                            <input tySpe="password" class="form-control" name="password" value="{{ $data->password }}">
                        </div>
                        <div class="form-group">
                            <label for="credits">Role</label>
                            <input type="text" class="form-control" name="role" value='penjual'>
                        </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">Edit</button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
