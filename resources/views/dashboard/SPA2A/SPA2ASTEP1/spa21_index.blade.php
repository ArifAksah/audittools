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
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('audits.index') }}">SPA2A</a></li>
                            </ol>
                        </nav>
                        @if(auth()->user()->jabatan === 'Senior Manager')
                            <a href="{{ route('audits.create') }}" class="btn btn-primary mb-3">Tambah SP2A</a>
                        @endif
                        <!-- Filter and Search -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="basic-addon2">
                            <button class="btn btn-outline-secondary" type="button">Filter</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor Surat</th>
                                        <th>Judul Audit</th>
                                        <th>Bidang Audit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($audits as $audit)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $audit->nomor_surat }}</td>
                                        <td>{{ $audit->judul_audit }}</td>
                                        <td>{{ $audit->bidang_audit }}</td>
                                        <td>
                                            <a href="{{ route('audits.show', $audit->id) }}" class="btn btn-primary btn-sm">Detail</a>
                                            <a href="{{ route('audits.edit', $audit->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('audits.destroy', $audit->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this audit?')">Delete</button>
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
        <!-- / Content wrapper -->
    </div>
    <!-- / Layout page -->
</x-app-layout>
