<x-app-layout>
    <!-- Layout container -->
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('lhappreview.index') }}">Audit</a></li>
                                <li class="breadcrumb-item active" aria-current="page">LHAP Details</li>
                            </ol>
                        </nav>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>LHAP ID</th>
                                        <th>LHAP Name</th>
                                        <th>Auditor KKA</th>
                                        <th>Ketua Tim Notes</th>
                                        <th>Pengawas Notes</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lhaps as $lhap)
                                    <tr>
                                        <td>{{ $lhap->id }}</td>
                                        <td>{{ $lhap->audit_kka }}</td>
                                        <td>{{ $lhap->auditor_kka }}</td>
                                        <td>
                                            <ul>
                                                @foreach(json_decode($notesKetuaTim) as $note)
                                                    @if($note->id_lhap == $lhap->id)
                                                        @foreach(json_decode($note->notes) as $subnote)
                                                            <li>{{ $subnote }}</li>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach(json_decode($notesPengawas) as $note)
                                                    @if($note->id_lhap == $lhap->id)
                                                        @foreach(json_decode($note->notes) as $subnote)
                                                            <li>{{ $subnote }}</li>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>
                                            <a href="{{ route('lhap.detaillhap', ['id_audit' => $lhap->id_audit, 'id_lhap' => $lhap->id]) }}" class="btn btn-primary">Detail LHAP</a>
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
