<!-- resources/views/dashboard/KKA/indexsubkka.blade.php -->
<x-app-layout>
    <!-- Layout container -->
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="#">SP2A</a></li>
                            </ol>
                        </nav>
                        <!-- Filter and Search -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2">
                            <button class="btn btn-outline-secondary" type="button">Search</button>
                        </div>
                       
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nomor KKA</th>
                                        <th>Nama Audit </th>
                                        <th>Nama Auditor </th>
                                        <th>Nama Ketua Tim</th>
                                        <th>Review</th>
                                        <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lhaps as $lhap)
                                        <tr>
                                            <td>{{ $lhap->nomor_kka }}</td>
                                            <td>{{ $lhap->audit_kka }}</td>
                                            <td>{{ $lhap->auditor_kka }}</td>
                                            <td>{{ $lhap->nama_ketuatim }}</td>
                                            <td>
                                            <a href="{{ route('reviewkkapengawas.show', ['id' => $lhap->id]) }}" class="btn btn-primary">Review Pengawas</a>
                                            </td>
                                            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content wrapper -->
    </div>
    <!-- / Layout page -->
</x-app-layout>
