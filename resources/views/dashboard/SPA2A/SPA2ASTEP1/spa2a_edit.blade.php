<x-app-layout>
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-header">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('audits.index') }}">SPA2A</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('audits.edit', $audit->id) }}">Edit SPA2A</a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="card-header d-flex justify-content-end"> 
                        <a href="{{ route('audits.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('audits.update', $audit->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nomor_surat" class="form-label">Nomor Surat:</label>
                                <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" value="{{ $audit->nomor_surat }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="judul_audit" class="form-label">Judul Audit:</label>
                                <input type="text" name="judul_audit" id="judul_audit" class="form-control" value="{{ $audit->judul_audit }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="bidang_audit" class="form-label">Bidang Audit:</label>
                                <select name="bidang_audit" id="bidang_audit" class="form-control" required>
                                    @foreach($bidangAudits as $bidangAudit)
                                        <option value="{{ $bidangAudit->bidang_audit }}" {{ $bidangAudit->bidang_audit === $audit->bidang_audit ? 'selected' : '' }}>
                                            {{ $bidangAudit->bidang_audit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="mulai" class="form-label">Periode:</label>
                                <div class="d-flex">
                                    <input type="date" name="mulai" id="mulai" value="{{ $audit->mulai }}" class="form-control me-2" required>
                                    <span>s.d</span>
                                    <input type="date" name="selesai" id="selesai" value="{{ $audit->selesai }}" class="form-control ms-2" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('bidang_audit').addEventListener('change', function() {
            var select = this;
            var idInput = document.querySelector('input[name="id_bidang_audit"]');
            var selectedOption = select.options[select.selectedIndex];
            idInput.value = selectedOption.value;
        });
    </script>
</x-app-layout>
