<x-app-layout>
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center">Daftar Laporan Hasil Audit Final</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Audit</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($audits as $audit)
                                    <tr>
                                        <td>{{ $audit->judul_audit }}</td>
                                        <td>{{ $audit->created_at }}</td>
                                        <td>
                                            <a href="{{ route('lhaf.show', $audit->id) }}" class="btn btn-info">Lihat Detail</a>
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
</x-app-layout>
