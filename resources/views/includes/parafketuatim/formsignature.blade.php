<div class="card-body">
    <h1>Ini adalah paraf ketua tim</h1>
    <form id="signatureForm" method="POST" action="{{ route('parafketuatim.save') }}"> <!-- Menyesuaikan dengan nama rute yang telah Anda definisikan -->
        @csrf
        <div class="col-md-12">
            <div class="form-group">
                <label for="id_user">User ID:</label>
                <input type="text" name="id_user" class="form-control" value="{{ $userId }}" required>
            </div>
            <div class="form-group">
                <label for="id_audit">Audit ID:</label>
                <input type="text" name="id_audit" class="form-control" value="{{ $audit->id }}" required>
            </div>
            <label>Tanda tangan</label>
            <br/>
            <canvas id="sig_ketua_tim" width="400" height="200" style="border: 1px solid #ccc;"></canvas> <!-- Mengubah ID elemen -->
            <br/><br/>
            <button id="clear_ketua_tim" class="btn btn-danger btn-sm">Clear</button>
            <textarea id="signature_ketua_tim" name="tandatangan" style="display: none"></textarea> <!-- Mengubah ID elemen -->
        </div>
        <br/>
        <button type="submit" id="submitButton" class="btn btn-primary">Save</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var canvas = document.getElementById('sig_ketua_tim'); // Mengubah ID elemen
        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)'
        });

        $('#clear_ketua_tim').click(function(e){ // Mengubah ID tombol clear
            e.preventDefault();
            signaturePad.clear();
            $('#signature_ketua_tim').val(''); // Mengosongkan textarea
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
            $('#signature_ketua_tim').val(signaturePad.toDataURL()); // Mengubah ID elemen
            this.submit();
        });
    });
</script>
