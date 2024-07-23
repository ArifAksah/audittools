<!-- resources/views/modalsdeleteaudity.blade.php -->

<!-- Modal Delete audity -->
@foreach($audities as $auditi)
    <div class="modal fade" id="deleteModal{{$auditi->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModal{{$auditi->id}}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal{{$auditi->id}}Label">Delete Audity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus audity ini?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('audity.hapus', $auditi->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- End modal delete audity -->
