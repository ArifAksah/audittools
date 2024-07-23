<!-- resources/views/modalsupdateauditor.blade.php -->

<!-- Modal Update auditor -->
@foreach($auditor as $auditor)
    @if($auditor)
    <div class="modal fade" id="updateModal{{$auditor->id}}" tabindex="-1" role="dialog" aria-labelledby="updateModal{{$auditor->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Auditor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk update -->
                    <form action="{{ route('auditors.update', $auditor->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $auditor->nama }}" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan:</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value= required>
                            <select name="jabatan" id="jabatan" class="form-control" required>
                                <option value="{{ $auditor->jabatan }}">{{$auditor->jabatan }}</option>
                                <option value="Pengawas">Pengawas</option>
                                <option value="Ketua Tim">Ketua Tim</option>
                                <option value="Auditor">Auditor</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach
<!-- End modal update auditor -->
