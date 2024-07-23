<div class="card-body">
    <h1>ini adalah paraf Pengawas</h1>
<form id="signatureForm" method="POST" action="{{ route('signpad.save') }}">
    @csrf
    <div class="col-md-12">
        <div class="form-group" >
            <label for="id_user">User ID:</label>
            <input type="text" name="id_user" class="form-control" value="{{ $userId }}" required>
        </div>
        <div class="form-group" >
            <label for="id_audit">Audit ID:</label>
            <input type="text" name="id_audit" class="form-control" value="{{ $audit->id }}" required>
        </div>
        <label>Tanda tangan</label>
        <br/>
        <canvas id="sig" width="400" height="200" style="border: 1px solid #ccc;"></canvas>
        <br/><br/>
        <button id="clear" class="btn btn-danger btn-sm">Clear</button>
        <textarea id="signature" name="signed" style="display: none"></textarea>
    </div>
    <br/>
    <button type="submit" id="submitButton" class="btn btn-primary">Save</button>
</form>

</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var canvas = document.getElementById('sig');
        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)'
        });

        $('#clear').click(function(e){
            e.preventDefault();
            signaturePad.clear();
            $('#signature').val('');
        });

        $('#signatureForm').submit(function(e){
            // Menghentikan proses pengiriman formulir
            e.preventDefault();

            // Cek apakah tanda tangan telah diberikan
            if(signaturePad.isEmpty()){
                alert('Please provide a signature first.');
                return;
            }

            // Jika tanda tangan telah diberikan, lanjutkan dengan pengiriman formulir
            $('#signature').val(signaturePad.toDataURL());
            this.submit();
        });
    });
</script>
