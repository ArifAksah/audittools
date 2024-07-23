<!-- resources/views/modalsdeleteauditor.blade.php -->

<!-- Modal Delete auditor -->
@foreach($auditor as $auditor)
    @if($auditor)
    <div class="modal fade" id="deleteModal{{$auditor->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModal{{$auditor->id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Auditor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus auditor ini?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('auditors.destroy', $auditor->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach
<!-- End modal delete auditor -->
