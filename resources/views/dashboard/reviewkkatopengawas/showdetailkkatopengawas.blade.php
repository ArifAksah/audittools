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
                        <!-- modal komentar -->
                        <!-- Modal Backdrop -->
                        <div class="col-lg-4 col-md-3">
                            <div class="mt-3">
                                <!-- Button trigger modal -->
                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#backDropModal"
                                >
                                    Send Feedback
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
                                    <div class="modal-dialog">
                                        <form action="{{ route('reviewkkapengawas.notes', $lhap->id) }}" method="POST" class="modal-content" id="addNoteForm">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="backDropModalTitle">Masukkan Preview Perbaikan KKA </h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                ></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-4">
                                                        <label for="catatan" class="form-label">Catatan </label>
                                                        <input
                                                            type="text"
                                                            id="catatan"
                                                            name="notes[]"
                                                            class="form-control"
                                                            placeholder="Masukkan Catatan"
                                                        />
                                                    </div>
                                                    <div class="col mb-4">
                                                        <label for="status" class="form-label">Status</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="Diterima">Diterima</option>
                                                            <option value="Ditolak">Ditolak</option>
                                                            <option value="Revisi">Revisi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Field catatan dinamis -->
                                                <div id="additionalNotes"></div>
                                                <button type="button" class="btn btn-success" id="addNoteBtn">Tambah Catatan</button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end modal komentar -->
                        <!-- Filter and Search -->
                        <div class="input-group mb-3">
                        </div>
                        <h1 class="text-center">KERTAS KERJA AUDIT REVIU PENGAWAS</h1>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <tbody>
                                        <tr hidden>
                                            <th class="bg-info text-white">ID:</th>
                                            <td>{{ $lhap->id }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-info text-white">Nomor KKA:</th>
                                            <td>{{ $lhap->nomor_kka }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-info text-white">Auditor:</th>
                                            <td>{{ $lhap->auditor_kka }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-info text-white">Obyek Audit:</th>
                                            <td>{{ $lhap->audit_kka }}</td>
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
                                            <td>{{ $lhap->kondisi_teks }}</td>
                                        </tr>
                                        @if($lhap->kondisi_images)
                                            <tr>
                                                <th >Bukti Kondisi :</th>
                                                <th>
                                                    @foreach(json_decode($lhap->kondisi_images) as $image)
                                                        <img src="{{ asset('storage/'.$image) }}" alt="Kondisi Image" width="500px" style="display: block; margin-bottom: 10px;">
                                                    @endforeach
                                                </th>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th >Kriteria :</th>
                                            <td>{{ $lhap->kriteria_teks }}</td>
                                        </tr>
                                        @if($lhap->kriteria_images)
                                            <tr>
                                                <th >Bukti Kriteria :</th>
                                                <td>
                                                    @foreach(json_decode($lhap->kriteria_images) as $image)
                                                        <img src="{{ asset('storage/'.$image) }}" alt="Kriteria Image" width="500px" style="display: block; margin-bottom: 10px;">
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif
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
    <script src="{{ asset('js/reviewpengawas/multiplefieldpengawas.js') }}"></script>
</x-app-layout>
