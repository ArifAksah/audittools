<x-app-layout>
    <!-- Layout container -->
    <div class="layout-page">
    @include('layouts.searchnavigation')
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container">
        <div class="card">
            <div class="card-header">
            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item " ><a href="{{ route('audits.index') }}">SPA2A</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('audits.create') }}">Buat SPA2A</a></li>
            </ol>
            </nav>
            </div>
            <div class="card-header d-flex justify-content-end"> 
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <a href="{{ route('audits.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        <div class="card-header">Tambah Jadwal Audit SP2A</div>

        <div class="card-body">
            <form action="{{ route('jadwal-audits.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="id_audit" class="form-label">ID Audit:</label>
                    <input type="number" name="id_audit" id="id_audit" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="nama_kegiatan" class="form-label">Nama Kegiatan:</label>
                    <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="mulai" class="form-label">Mulai:</label>
                    <input type="datetime-local" name="mulai" id="mulai" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="selesai" class="form-label">Selesai:</label>
                    <input type="datetime-local" name="selesai" id="selesai" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="upload_dokumen" class="form-label">Upload Dokumen:</label>
                    <input type="file" name="upload_dokumen" id="upload_dokumen" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>