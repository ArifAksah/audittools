<x-app-layout>
    <div class="layout-page">
        @include('layouts.searchnavigation')
        <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="card">
                    <div class="card-body">
                        <!-- Cover Section -->
                        <div class="cover-container">
                            <img src="{{ asset('cover.png') }}" alt="Cover Image" class="cover-image">
                            <div class="cover-text">    
                                <br>
                                <br>
                                <h1>Laporan Hasil Audit Final</h1>
                                <p>{{$mulai}}</p>
                            </div>
                        </div>
                            <!-- Pendahuluan -->
                            <div class="pendahuluan">
                            <p>
                                <br>
                                <br><br>
                                <b>Kepada Yth. : Bapak Direktur Utama</b><br>
                                Dari        :GM of Internal Audit<br>
                                Nomor       : 07/LHAF/PW.OO/1 1.00/02-2021<br>
                                Lampiran    : I (satu) rangkap<br>
                                Perihal     : Laporan Hasil Audit Capex Tahun 2021<br>
                                <br>
                                Dengan hormat,<br>
                                Sesuai dengan Surat Perintah Pelaksanaan Audit (SP2A) No. 01/SP2A/PW.OO/1 1.00/01-2021 tanggal 28 Januari 2021 perihal audit capex pada PT Semen Tonasa dengan periode data audit tahun 2016 s/d 2020, kami telah melaksanakan evaluasi dan kajian pada unit kerja yang telah menyelesaikan proses capexnya serta telah melaksanakan klarifikasi dengan unit kerja terkait audit capex tersebut pada tanggal 24 Pebruari 2021.<br>
                                <br>
                                Audit tersebut dimaksudkan untuk mengevaluasi efektivitas operasional terkait dengan program capex yang telah dilaksanakan dan memberikan rekomendasi berbagai hal yang dipandang perlu agar dapat meningkatkan efektivitas, efisien, dan ekonomis.<br>
                                <br>
                                Hasil audit kami sajikan dalam bentuk laporan audit meliputi:
                                    <p>BAB I: Tujuan dan Ruang lingkup Audit</p>
                                    <p>BAB II: Hasil Audit dan Rekomendasi</p>
                                    <p>BAB III: Kesimpulan</p>
                                <br>
                                Dalam melaksanakan audit, kami telah memperoleh bantuan, dukungan, dan kerjasama dari berbagai pihak yang berhubungan dengan pelaksanaan audit ini. Untuk itu kami mengucapkan terima kasih atas bantuan, dukungan, dan kerjasama yang telah terjalin dengan baik.
                                <br><br>
                                Pangkep, 24 Maret 2021<br>
                                Departemen Internal Audit,
                            </p>
                            <p>Kepala</p>
                            <p>Tembusan:</p>
                            <ol>
                                <li>Komite Audit</li>
                                <li>Arsip</li>
                            </ol>
                        </div>

                        <!-- Daftar Isi -->
                        <div class="daftar-isi">
                            <h2 class="text-center">DAFTAR ISI</h2>
                            <ul>
                                <li>BAB I: Tujuan dan Ruang Lingkup Audit</li>
                                <li>BAB II: Hasil Audit dan Rekomendasi</li>
                                <li>BAB III: Kesimpulan</li>
                            </ul>
                        </div>

                        <!-- Bab I -->
                        <div class="bab-i">
                            <h2 class="text-center">BAB I: Tujuan dan Ruang Lingkup Audit</h2>
                            <h3>1.1. Tujuan Audit</h3>
                            <ul>
                                <li>Memastikan bahwa capex yang telah disetujui sudah dilaksanakan berdasarkan maksud dan tujuan capex pada Feasibility Study (FS) capex tersebut.</li>
                                <li>Untuk mendapatkan data informasi capex yang telah mendapat persetujuan tersebut meliputi realisasi pekerjaan, efisiensi, produktivitas, biaya pemeliharaan, dan manfaat lainnya.</li>
                            </ul>
                            <h3>1.2. Ruang Lingkup Audit</h3>
                            <p>
                                Audit capex dilaksanakan berdasarkan RKIA tahun 2021 dan Surat Perintah Pelaksanaan Audit (SP2A) No. 01/SP2A/PW.OO/1 I -2021 tanggal 28 Januari 2021. Periode audit berdasarkan data capex tahun 2016 s/d 2020, namun dengan terbatasnya tenaga auditor dan waktu pelaksanaan audit maka audit capex tahun 2021 ini dilakukan berdasarkan sampel 20 nilai tertinggi capex yang belum terpasang pada tahun obyek audit. Audit capex ini dilakukan melalui audit lapangan dan evaluasi dokumen capex serta melakukan klarifikasi dengan auditee.
                            </p>
                            <p>Program dan pengujian kegiatan audit capex meliputi:</p>
                            <ul>
                                <li>Memastikan pelaksanaan pemasangan barang capex yang telah dilaksanakan proses pengadaannya apakah telah sesuai dokumen Feasibility Study capex tersebut.</li>
                                <li>Memastikan barang capex yang telah terpenuhi delivery date-nya dan telah menjadi aset produktif.</li>
                                <li>Memastikan realisasi capex periode 2016 - 2020 tidak merugikan perusahaan dengan investasi yang dikeluarkan untuk perolehan barang capex tersebut.</li>
                            </ul>
                            <p>Adapun susunan Tim Audit sesuai yang tertuang dalam Surat Perintah Pelaksanaan Audit (SP2A) sebagai berikut:</p>
                            <ul>
                                <li>Pengawas: DR. H. A. Mulyadi Radjab, MM.</li>
                                <li>Ketua Tim: Ir. H. BASRI</li>
                                <li>Auditor:
                                    <ul>
                                        <li>Arman. S, S.Kom</li>
                                        <li>A. Irsal Wahid, A.Md.</li>
                                        <li>Muh. Amir, ST</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        @if($lhafs->isEmpty())
                            <p class="text-center">Tidak ada LHAP yang diterima untuk audit ini.</p>
                        @else
                         <h2 class="text-center">BAB II: HASIL AUDIT  </h2>
                         <p class="text-center">(DIURAIKAN SEBAGAI BERIKUT)</p>
                        @foreach($lhafs as $lhap)
                       
                            <div class="lhap-section">
                                <h4>Kondisi</h4>
                                <p>{{ $lhap->kondisi_teks }}</p>
                                @if($lhap->kondisi_images)
                                    <strong>Bukti Kondisi:</strong><br>
                                    <div class="image-center">
                                        @foreach(json_decode($lhap->kondisi_images) as $image)
                                            <img src="{{ asset('storage/'.$image) }}" alt="Kondisi Image" width="300px" style="margin-bottom: 10px;">
                                        @endforeach
                                    </div>
                                @endif

                                <h4>Kriteria</h4>
                                <p>{{ $lhap->kriteria_teks }}</p>
                                @if($lhap->kriteria_images)
                                    <strong>Bukti Kriteria:</strong><br>
                                    <div class="image-center">
                                        @foreach(json_decode($lhap->kriteria_images) as $image)
                                            <img src="{{ asset('storage/'.$image) }}" alt="Kriteria Image" width="300px" style="margin-bottom: 10px;">
                                        @endforeach
                                    </div>
                                @endif

                                <h4>Sebab</h4>
                                <p>{{ $lhap->sebab }}</p>

                                <h4>Akibat</h4>
                                <p>{{ $lhap->akibat }}</p>

                                <h4>Rekomendasi</h4>
                                <p>{{ $lhap->rekomendasi }}</p>

                                <h4>Evidence</h4>
                                <p>{{ $lhap->evidence }}</p>
                            </div>

                            <hr>
                        @endforeach

                        @endif
                        <h5>Catatan dari GM</h5>
                        @if($notesGM->isEmpty())
                            <p>Tidak ada catatan dari GM untuk LHAP ini.</p>
                        @else
                            <ul>
                                @foreach($notesGM as $note)
                                    <li>{{ implode(', ', json_decode($note->notes)) }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <!-- Bab III -->
                        <div class="bab-iii">
                            <h2 class="text-center">BAB III: Kesimpulan</h2>
                            <ol>
                                <li>Secara umum program capex terutama yang disetujui sudah berjalan dengan baik sesuai dengan tujuan diadakannya capex tersebut, namun monitoring pelaksanaan/pemasangan capex tersebut tidak dilakukan untuk menjamin efektivitas investasi barang capex.</li>
                                <li>Untuk memaksimalkan hasil audit capex maka laporan hasil audit yang telah diklarifikasi dan disepakati dengan Auditee segera ditindaklanjuti atas seluruh rekomendasi yang disampaikan dalam Laporan Hasil Audit ini.</li>
                                <li>Selanjutnya diharapkan terjadi peningkatan kinerja pada unit kerja peminta capex dan keterbukaan informasi antara unit kerja tersebut dengan Departemen Internal Audit untuk memaksimalkan pencapaian tujuan perusahaan.</li>
                                <li>Dengan banyaknya jumlah capex yang masih perlu pemeriksaan namun dengan terbatasnya waktu pelaksanaan audit capex tahun ini maka masih sangat memungkinkan untuk dilanjutkan audit capex pada tahun-tahun mendatang sehingga diharapkan seluruh capex dapat dipastikan telah berjalan dan sesuai dengan tujuan diadakannya capex-capex tersebut.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- CSS for Cover -->
<style>
    .cover-container {
        position: relative;
        text-align: center;
        color: white;
    }
    .cover-image {
        width: 100%;
        height: auto;
    }
    .cover-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    .cover-text h1 {
        font-size: 4rem;
        margin-bottom: 0;
    }
    .cover-text p {
        font-size: 1.5rem;
    }
    .lhap-section {
        margin-bottom: 20px;
    }
    .lhap-section h4 {
        font-size: 1.25rem;
        color: #555;
    }
    .lhap-section p, .lhap-section ul {
        font-size: 1rem;
        color: #666;
    }
    .text-center {
        text-align: center;
    }
    .image-center {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }
    .image-center img {
        margin: 10px;
    }
    .pendahuluan, .daftar-isi, .bab-i, .bab-iii {
        margin-bottom: 30px;
    }
    .pendahuluan p, .daftar-isi ul, .bab-i p, .bab-i ul, .bab-iii ol {
        font-size: 1rem;
        color: #666;
    }
</style>