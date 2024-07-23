<x-app-layout>
    <!-- Layout container -->
    <div class="layout-page">
        <!-- Navbar -->
        @include('layouts.searchnavigation')
        <!-- / Navbar -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row">
                    <!-- General Manager Dashboard -->
                    @if(auth()->user()->jabatan === 'General Manager')
                        <div class="col-lg-8 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }} </h5>
                                            <p class="mb-4">
                                                Anda memiliki hak akses sebagai General Manager. Anda dapat mengakses semua fitur dan informasi.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 order-1">
                            <!-- Tambahkan card untuk General Manager di sini -->
                        </div>
                    <!-- Senior Manager Dashboard -->
                    @elseif(auth()->user()->jabatan === 'Senior Manager')
                    <div class="col-lg-8 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }} </h5>
                                            <p class="mb-4">
                                                Anda memiliki hak akses sebagai Senior Manager. Anda dapat mengakses semua fitur dan informasi.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 order-1">
                            <!-- Tambahkan card untuk General Manager di sini -->
                        </div>
                    <!-- Auditor Dashboard -->
                    @elseif(auth()->user()->auditors->where('jabatan', 'Auditor')->isNotEmpty())
                    <div class="col-lg-8 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }} </h5>
                                            <p class="mb-4">
                                                Anda memiliki hak akses sebagai Auditor. Anda dapat mengakses semua fitur dan informasi.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 order-1">
                            <!-- Tambahkan card untuk General Manager di sini -->
                        </div>
                    @endif
                </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                    <div class="mb-2 mb-md-0">
                        ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        , made with Muh. Arif
                        <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder"></a>
                    </div>
                    <div>
                    </div>
                </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
</x-app-layout>
