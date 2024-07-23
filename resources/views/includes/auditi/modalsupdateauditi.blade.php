<!-- resources/views/modalsupdateaudity.blade.php -->

<!-- Modal Update audity -->
@foreach($audities as $auditi)
    <div class="modal fade" id="updateModal{{$auditi->id}}" tabindex="-1" role="dialog" aria-labelledby="updateModal{{$auditi->id}}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModal{{$auditi->id}}Label">Update Audity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk update -->
                    <form action="{{ route('audity.update', $auditi->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="departemen{{$auditi->id}}">Departemen:</label>
                            <input type="text" class="form-control" id="departemen{{$auditi->id}}" name="departemen" value="{{ $auditi->departemen }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- End modal update audity -->
