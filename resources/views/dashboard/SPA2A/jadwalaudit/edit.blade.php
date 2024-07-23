<div class="container">
    <div class="card">
        <div class="card-header">Edit Jadwal Audit SP2A</div>

        <div class="card-body">
            <form action="{{ route('jadwal-audits.update', $jadwalAudit->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id_audit" class="form-label">ID Audit:</label>
                    <input type="number" name="id_audit" id="id_audit" class="form-control" value="{{ $jadwalAudit->id_audit }}" required>
                </div>
                <div class="mb-3">
                    <label for="nama_kegiatan" class="form-label">Nama Kegiatan:</label>
                    <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" value="{{ $jadwalAudit->nama_kegiatan }}" required>
                </div>
                <div class="mb-3">
                    <label for="mulai" class="form-label">Mulai:</label>
                    <input type="datetime-local" name="mulai" id="mulai" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($jadwalAudit->mulai)) }}" required>
                </div>
                <div class="mb-3">
                    <label for="selesai" class="form-label">Selesai:</label>
                    <input type="datetime-local" name="selesai" id="selesai" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($jadwalAudit->selesai)) }}" required>
                </div>
                <div class="mb-3">
                    <label for="upload_dokumen" class="form-label">Upload Dokumen:</label>
                    <input type="file" name="upload_dokumen" id="upload_dokumen" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>