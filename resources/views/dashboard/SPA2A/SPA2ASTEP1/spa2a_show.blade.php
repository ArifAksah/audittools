<x-app-layout>
    <!-- Layout container -->
    <div class="layout-page">
    @include('layouts.searchnavigation')
    <!-- Content wrapper -->
    <div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
        @if (session('success'))
            <div class="alert alert-success">
                <span>{{ session('success') }}</span>
            </div>
        @endif
            <div class="card-header">Detail Audit</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"><strong>Nomor Surat:</strong></div>
                    <div class="col-md-9">{{ $audit->nomor_surat }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Judul Audit:</strong></div>
                    <div class="col-md-9">{{ $audit->judul_audit }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><strong>Bidang Audit:</strong></div>
                    <div class="col-md-9">{{ $audit->bidang_audit }}</div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('audits.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <!-- Detail SPA2A -->
            <!-- pills -->
            <div class="col-xl-12">
                  <div class="nav-align-top mb-4">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link active"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-home"
                          aria-controls="navs-pills-justified-home"
                          aria-selected="true"
                        >
                          <i class="tf-icons bx bx-home"></i> Jadwal Audit
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-profile"
                          aria-controls="navs-pills-justified-profile"
                          aria-selected="false"
                        >
                          <i class="tf-icons bx bx-user"></i> Auditor
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-justified-messages"
                          aria-controls="navs-pills-justified-messages"
                          aria-selected="false"
                        >
                          <i class="tf-icons bx bx-message-square"></i> Auditi
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-preview"
                          aria-controls="navs-pills-preview"
                          aria-selected="false"
                        >
                          <i class="tf-icons bx bx-message-square"></i> Preview SP2A
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                          @include('includes.jadwalaudit.formjadwalaudit')
                          <!-- Modals Updatejadwalaudit -->
                          @include('includes.jadwalaudit.showjadwalaudit')
                          <!-- End Modal Updatejadwalaudit -->
                          <!-- Modals Updatejadwalaudit -->
                          @include('includes.jadwalaudit.modalsupdatejadwalaudit')
                          <!-- End Modal Updatejadwalaudit -->
                      </div>
                      <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                          @include('includes.auditors.formauditors')
                          @include('includes.auditors.indexauditor')
                          @include('includes.auditors.modalsupdateauditor')
                          @include('includes.auditors.modalsdeleteauditor')
                      </div>
                      <!-- spa2a preview -->
                      <div class="tab-pane fade" id="navs-pills-preview" role="tabpanel">
                      @include('includes.sp2apreview.spa2preview')
                      </div>
                      <!-- end sp2a preview -->
                      <!-- signature document -->
                      <div class="tab-pane fade" id="navs-pills-pad" role="tabpanel">
                      @include('includes.signature-pad.formsignature')
                      </div>
                      <!-- end signature document -->
                      <!-- paraf ketua tim -->
                      <div class="tab-pane fade" id="navs-pills-ketuatim" role="tabpanel">
                      @include('includes.parafketuatim.formsignature')
                      </div>
                      <!-- end paraf ketua tim -->
                      <!-- paraf Pengawas -->
                      <!-- <div class="tab-pane fade" id="navs-pills-pengawas" role="tabpanel">
                      @include('includes.parafpengawas.formsignature')
                      </div> -->
                      <!-- end paraf pengawas -->
                      <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                      <!-- auditi -->
                      @include('includes.auditi.formauditi')
                      @include('includes.auditi.showauditi')
                      @include('includes.auditi.modalsupdateauditi')
                      @include('includes.auditi.modalsdeleteauditi')
                      <!-- end auditi -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Pills -->
        </div>
    </div>
    </div>
          <!-- Content wrapper -->
    </div>
        <!-- / Layout page -->
        <!-- Script untuk logika javascript hapus audity  -->
        <script>
            function hapusAudity(event) {
                event.preventDefault();
                var audityId = $(event.target).data('id');
                if (confirm("Anda yakin ingin menghapus Audity ini?")) {
                    $.ajax({
                        url: '/audity/' + audityId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // Handle success, misalnya reload halaman atau hapus elemen dari DOM
                            console.log('Audity berhasil dihapus');
                        },
                        error: function(xhr) {
                            // Handle error
                            console.error('Gagal menghapus Audity');
                        }
                    });
                }
            }
        </script>
        <!-- end script unutk logika javascript -->
        <!-- Logika modalsupdate jadwal audit  -->
        @push('scripts')
            <script src="{{ asset('js/jadwalaudit/jadwalauditupdatemodal.js') }}"></script>
        @endpush
        <!-- End Logika modalsupdate jadwal audit -->
        <!-- Script untuk logika select live -->
        <script>
            // To style all selects
            $('select').selectpicker();
        </script>
        <!-- end script untuk logika select live -->

</x-app-layout>