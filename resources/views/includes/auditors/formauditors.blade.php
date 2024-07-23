<form method="POST" action="{{ route('auditors.simpan') }}">
    @csrf
    <div class="form-group" hidden>
        <label for="id_audit">Audit ID:</label>
        <input type="text" name="id_audit" class="form-control" value="{{ $audit->id }}" required>
    </div>
    <div class="form-group">
        <label for="nama">Nama:</label>
        <select name="nama" id="nama" class="form-control" required>
            <option value="#">~pilih~</option>
            @foreach($users as $user)
                <option value="{{ $user->name }}" data-userid="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="jabatan">Jabatan:</label>
        <select name="jabatan" id="jabatan" class="form-control" required>
            <option value="#">~pilih~</option>
            <option value="Pengawas">Pengawas</option>
            <option value="Ketua Tim">Ketua Tim</option>
            <option value="Auditor">Auditor</option>
        </select>
    </div>
    <!-- Inputan tambahan untuk menyimpan id_user yang dipilih -->
    <input type="hidden" name="id_user" id="id_user">

    <button type="submit" class="btn btn-primary">Add Auditor</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('select[name="nama"]').change(function () {
            var selectedUserName = $(this).val(); // Mendapatkan nama yang dipilih
            var selectedUserId = $(this).find(':selected').data('userid'); // Mendapatkan id_user yang sesuai

            // Memasukkan nilai nama dan id_user ke dalam input hidden
            $('#id_user').val(selectedUserId);
        });
    });
</script>
