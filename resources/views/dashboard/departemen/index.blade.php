<x-app-layout>
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">SPA2A</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="#">Buat SPA2A</a></li>
                            </ol>
                        </nav>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Daftar Departemen</h5>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Tambah Departemen</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Departemen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departemens as $departemen)
                                    <tr>
                                        <td>{{ $departemen->id }}</td>
                                        <td>{{ $departemen->nama_departemen }}</td>
                                        <td>
                                            <a href="{{ route('departemens.units', $departemen->id) }}" class="btn btn-info btn-sm">Detail</a>
                                            <a href="{{ route('departemens.edit', $departemen->id) }}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $departemen->id }}">Edit</a>
                                            <form action="{{ route('departemens.destroy', $departemen->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus departemen ini?')">Delete</button>
                                            </form>
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

    <!-- Modal Create Departemen -->
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Departemen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('departemens.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_departemen">Nama Departemen:</label>
                            <input type="text" class="form-control" id="nama_departemen" name="nama_departemen" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
