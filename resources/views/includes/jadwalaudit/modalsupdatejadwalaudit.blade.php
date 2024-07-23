@foreach($jadwalAudits as $jadwalAudit)
    <div class="modal fade" id="updateModal{{$jadwalAudit->id}}" tabindex="-1" role="dialog" aria-labelledby="updateModal{{$jadwalAudit->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Jadwal Audit SP2A</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk update -->
                    <form action="{{ route('jadwal-audits.update', $jadwalAudit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="id_audit">ID Audit:</label>
                            <input type="text" class="form-control" id="id_audit" name="id_audit" value="{{$jadwalAudit->id_audit}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan:</label>
                            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{$jadwalAudit->nama_kegiatan}}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="mulai">Mulai:</label>
                            <input type="date" class="form-control" id="mulai" name="mulai" value="{{ \Carbon\Carbon::parse($jadwalAudit->mulai)->format('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="selesai">Selesai:</label>
                            <input type="date" class="form-control" id="selesai" name="selesai" value="{{ \Carbon\Carbon::parse($jadwalAudit->selesai)->format('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="upload_dokumen">Upload Dokumen:</label>
                            <input type="file" class="form-control-file" id="upload_dokumen{{$jadwalAudit->upload_dokumen}}" name="upload_dokumen">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
