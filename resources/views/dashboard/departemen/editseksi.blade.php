<!-- resources/views/seksis/edit.blade.php -->

<x-app-layout>
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Edit Seksi - {{ $seksi->nama_seksi }}</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('seksis.update', $seksi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_seksi">Nama Seksi:</label>
                                <input type="text" class="form-control" id="nama_seksi" name="nama_seksi" value="{{ $seksi->nama_seksi }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
