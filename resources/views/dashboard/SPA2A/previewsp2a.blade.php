<x-app-layout>
    <!-- Layout container -->
    <div class="layout-page">
    @include('layouts.searchnavigation')
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
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
            <h1>Detail Audit</h1>
            <p><strong>ID:</strong> {{ $audit->id }}</p>
            <p><strong>Judul:</strong> {{ $audit->judul_audit }}</p>
            <p><strong>Bidang:</strong> {{ $audit->bidang_audit }}</p>
            <hr>
            
            <h2>Auditor</h2>
            <ul>
                @foreach($auditors as $auditor)
                    <li>{{ $auditor->nama }} - {{ $auditor->jabatan }}</li>
                @endforeach
            </ul>
            <hr>
            
            <h2>Audity</h2>
            <ul>
                @foreach($audities as $audity)
                    <li>{{ $audity->nama }} - {{ $audity->keterangan }}</li>
                @endforeach
            </ul>
    </div>
    </div>
</div>