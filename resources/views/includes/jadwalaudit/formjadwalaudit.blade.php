<form action="{{ route('jadwal-audits.store') }}" method="POST"  enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3" hidden>
                                <label for="id_audit" class="form-label">ID Audit:</label>
                                <input type="number" name="id_audit" id="id_audit" class="form-control" value="{{ $audit->id }}" required >
                            </div>
                            <div class="mb-3">
                                <label for="nama_kegiatan" class="form-label">Nama Kegiatan:</label>
                                <select name="nama_kegiatan" id="nama_kegiatan" class="form-control">
                                  <option value="#">~Pilih~</option>
                                  <option value="Surat Perintah Pelaksanaan Audit">Surat Perintah Pelaksanaan Audit</option>
                                  <option value="Opening Meeting">Opening Meeting</option>
                                  <option value="Reviu Internal Control">Reviu Internal Control</option>
                                  <option value="Program Kerja Audit">Program Kerja Audit</option>
                                  <option value="Audit Lapangan">Audit Lapangan</option>
                                  <option value="Reviu Kertas Kerja Audit">Reviu Kertas Kerja Audit</option>
                                  <option value="Laporan Hasil Audit Pendahuluan">Laporan Hasil Audit Pendahuluan</option>
                                  <option value="Klarifikasi Temuan">Klarifikasi Temuan</option>
                                  <option value="Laporan Hasil Audit Final">Laporan Hasil Audit Final</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="mulai" class="form-label">Mulai:</label>
                                <input type="datetime-local" name="mulai" id="mulai" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="selesai" class="form-label">Selesai:</label>
                                <input type="datetime-local" name="selesai" id="selesai" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="upload_dokumen" class="form-label">Upload Dokumen:</label>
                                <input type="file" name="upload_dokumen" id="upload_dokumen" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </form>