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
                            <form method="POST" action="{{ route('lhap.reviewtoketuatim') }}" enctype="multipart/form-data">
                                @csrf
                                <!-- Tambahkan tombol review di sini -->
                                <input type="hidden" name="kka_id" value="{{ $kka->id }}">
                                @if($loggedInUser->jabatan !== 'General Manager' && $loggedInUser->jabatan !== 'Senior Manager')
                                    @if($audit->auditors->contains('id_user', $loggedInUser->id))
                                        <button type="submit" class="btn btn-outline-success">Kirim Untuk di Review </button>
                                    @endif
                                @endif
                            </form>
                            <a href="{{ route('kkas.edit', $kka->id) }}" class="btn btn-outline-warning">Edit</a>
                        </div>

                        <h1 class="text-center">KERTAS KERJA AUDIT</h1>
                        <h6 class="text-center">Periode {{$mulai}} s.d {{$selesai}} </h6>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tbody>
                                        <tr hidden>
                                            <th class="bg-info text-white">ID:</th>
                                            <td>{{ $kka->id }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-info text-white">Nomor KKA:</th>
                                            <td>{{ $kka->nomor_kka }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-info text-white">Auditor:</th>
                                            <td>{{ $kka->auditor_kka }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-info text-white">Obyek Audit:</th>
                                            <td>{{ $kka->audit_kka }}</td>
                                        </tr>
                                        <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12">
                                <table class="table">
                                    <tbody>
                                         <tr>
                                            <th >Kondisi:</th>
                                            <td>{{ $kka->kondisi_teks }}</td>
                                        </tr>
                                        @if($kka->kondisi_images)
                                            <tr>
                                                <th >Bukti Kondisi :</th>
                                                <th>
                                                    @foreach(json_decode($kka->kondisi_images) as $image)
                                                        <img src="{{ asset('storage/'.$image) }}" alt="Kondisi Image" width="500px" style="display: block; margin-bottom: 10px;">
                                                    @endforeach
                                                </th>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th >Kriteria :</th>
                                            <td>{{ $kka->kriteria_teks }}</td>
                                        </tr>
                                        @if($kka->kriteria_images)
                                            <tr>
                                                <th >Bukti Kriteria :</th>
                                                <td>
                                                    @foreach(json_decode($kka->kriteria_images) as $image)
                                                        <img src="{{ asset('storage/'.$image) }}" alt="Kriteria Image" width="500px" style="display: block; margin-bottom: 10px;">
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th >Sebab :</th>
                                            <td>{{ $kka->sebab }}</td>
                                        </tr>
                                        <tr>
                                            <th >Akibat :</th>
                                            <td>{{ $kka->akibat }}</td>
                                        </tr>
                                        <tr>
                                            <th >Rekomendansi :</th>
                                            <td>{{ $kka->rekomendasi }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content wrapper -->
    </div>
    <!-- / Layout page -->
</x-app-layout>
