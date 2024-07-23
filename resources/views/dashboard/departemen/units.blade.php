<x-app-layout>
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Detail Departemen - {{ $departemen->nama_departemen }}</h5>
                    </div>
                    <div class="card-body">
                        <h6>Daftar Unit Kerja</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Unit</th>
                                    <th>Nama Seksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($unitsKerja as $index => $unit)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $unit->nama_unit }}</td>
                                        <td>
                                            <!-- Detail button -->
                                            <a href="{{ route('units.show', $unit->id) }}" class="btn btn-info btn-sm">Detail</a>
                                            <!-- Update button -->
                                            <a href="{{ route('units.edit', $unit->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <!-- Delete button -->
                                            <form action="{{ route('units.destroy', $unit->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus unit ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <h6>Tambah Unit Kerja</h6>
                        <form action="{{ route('units.store', $departemen->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_unit">Nama Unit:</label>
                                <input type="text" class="form-control" id="nama_unit" name="nama_unit" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
