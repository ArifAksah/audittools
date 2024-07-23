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
                                <li class="breadcrumb-item active" aria-current="page"><a href="#">SPA2A</a></li>
                            </ol>
                        </nav>
                        <!-- Filter and Search -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2">
                            <button class="btn btn-outline-secondary" type="button">Search</button>
                        </div>

                        <div class="table-responsive">
                        @if($loggedInUser->jabatan !== 'General Manager' && $loggedInUser->jabatan !== 'Senior Manager')
                            @if($audit->auditors->contains('id_user', $loggedInUser->id))
                                <a href="{{ route('kkas.createAuditKka', $audit->id) }}" class="btn btn-primary">Tambah KKA</a>
                            @endif
                        @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nomor KKA</th>
                                        <th>Auditor KKA</th>
                                        <th>Audit KKA</th>
                                        <th>Detail KKA</th>
                                        <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kkas as $kka)
                                        <tr>
                                            <td>{{ $kka->nomor_kka }}</td>
                                            <td>{{ $kka->auditor_kka }}</td>
                                            <td>{{ $kka->audit_kka }}</td>
                                            <td>
                                            <a href="{{ route('kkas.detail', ['id' => $kka->id_audit, 'kka' => $kka->id]) }}" class="btn btn-primary">Detail KKA</a>
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
