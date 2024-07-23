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
                <a href="{{ route('audits.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <!-- Content -->
                <form action="{{ route('audits.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="judul_audit" class="form-label">Judul Audit:</label>
                        <input type="text" name="judul_audit" id="judul_audit" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="mulai" class="form-label">Periode :</label>
                        <div class="d-flex">
                            <input type="date" name="mulai" id="mulai" class="form-control me-2" required>
                            <span>s.d</span>
                            <input type="date" name="selesai" id="selesai" class="form-control ms-2" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="bidang_audit" class="form-label">Bidang Audit:</label>
                        <select name="bidang_audit" id="bidang_audit" class="form-control" required>
                            @foreach($bidangAudits as $bidangAudit)
                                {{-- Mengecek apakah bidang audit sama dengan bidang user yang sedang login --}}
                                @if($bidangAudit->bidang_audit === auth()->user()->bidang)
                                    <option value="{{ $bidangAudit->bidang_audit }}">
                                        {{ $bidangAudit->bidang_audit }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        <input type="hidden" name="id_bidang_audit">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        </div>
        <!-- / Content wrapper -->
    </div>
    </div>
    <!-- / Layout container -->
    <script>
    document.getElementById('bidang_audit').addEventListener('change', function() {
        var select = this;
        var idInput = document.querySelector('input[name="id_bidang_audit"]');
        var selectedOption = select.options[select.selectedIndex];
        idInput.value = selectedOption.value; // Mengambil nilai value dari opsi yang dipilih
    });
</script>

</x-app-layout>
