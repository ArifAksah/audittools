<x-app-layout>
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Unit Kerja</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('units.update', $unit->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_unit">Nama Unit:</label>
                                <input type="text" class="form-control" id="nama_unit" name="nama_unit" value="{{ $unit->nama_unit }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
