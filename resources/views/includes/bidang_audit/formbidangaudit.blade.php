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
                                <li class="breadcrumb-item"><a href="">Home</a></li>
                                <li class="breadcrumb-item"><a href="">SPA2A</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><a href="">Buat SPA2A</a></li>
                            </ol>
                        </nav>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Daftar Bidang Audit</h5>
                        </div>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Bidang Audits</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bidangAudits as $index => $bidangAudit)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $bidangAudit->bidang_audit }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <form method="POST" action="{{ route('bidang-audit.store') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="bidang_audit" class="form-label">Bidang Audit:</label>
                            <input type="text" class="form-control" id="bidang_audit" name="bidang_audit" required>
                            <div class="invalid-feedback">Please provide a bidang audit.</div>
                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                    </div>
                </div>
            </div>
            <!-- / Content wrapper -->
        </div>
    </div>
    <!-- / Layout container -->
    <!-- Toast -->
    <div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
        Hello, world! This is a toast message.
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    </div>
    <!-- End Toast -->
    <script>
    // Fungsi untuk menampilkan toast
    function showToast(message) {
        // Dapatkan elemen toast
        var toastElement = document.querySelector('.toast');

        // Ubah pesan dalam toast sesuai dengan pesan yang diberikan
        toastElement.querySelector('.toast-body').textContent = message;

        // Tampilkan toast
        var toast = new bootstrap.Toast(toastElement);
        toast.show();
    }

    // Fungsi untuk menangani pengiriman formulir
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault(); // Hindari pengiriman formulir secara default

        // Kirim formulir dengan menggunakan fetch API
        fetch(this.action, {
            method: this.method,
            body: new FormData(this),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (response.ok) {
                // Jika respons OK, tampilkan toast berhasil
                showToast('Bidang Audit berhasil disimpan.');
                // Bersihkan nilai bidang input
                document.getElementById('bidang_audit').value = '';
            } else {
                // Jika respons tidak OK, tampilkan pesan kesalahan
                showToast('Terjadi kesalahan. Bidang Audit tidak dapat disimpan.');
            }
        })
        .catch(error => {
            // Tangani kesalahan jaringan
            showToast('Terjadi kesalahan jaringan. Bidang Audit tidak dapat disimpan.');
            console.error('Error:', error);
        });
    });
</script>

</x-app-layout>
