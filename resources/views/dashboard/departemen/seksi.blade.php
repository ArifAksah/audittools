<!-- resources/views/units/show.blade.php -->

<x-app-layout>
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Detail Unit Kerja - {{ $unit->nama_unit }}</h5>
                    </div>
                    <div class="card-body">
                        <h6>Daftar Seksi</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Seksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($unit->seksis as $index => $seksi)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $seksi->nama_seksi }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('seksis.edit', $seksi->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('seksis.destroy', $seksi->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus seksi ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <h6>Tambah Seksi</h6>
                        <form action="{{ route('seksi.store', $unit->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_seksi">Nama Seksi:</label>
                                <input type="text" class="form-control" id="nama_seksi" name="nama_seksi" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
