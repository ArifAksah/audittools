document.addEventListener('DOMContentLoaded', function() {
    const addNoteBtn = document.getElementById('addNoteBtn');
    const additionalNotes = document.getElementById('additionalNotes');

    addNoteBtn.addEventListener('click', function() {
        // Buat field baru untuk catatan
        const newNoteField = document.createElement('div');
        newNoteField.classList.add('row');
        newNoteField.innerHTML = `
            <div class="col-10 mb-3">
                <input
                    type="text"
                    name="notes[]"
                    class="form-control"
                    placeholder="Masukkan Catatan"
                />
            </div>
            <div class="col-2 mb-3">
                <button type="button" class="btn btn-danger w-100" onclick="removeNoteField(this)"><span aria-hidden="true">&times;</span></button>
            </div>
        `;

        // Tambahkan field baru ke dalam div additionalNotes
        additionalNotes.appendChild(newNoteField);
    });
    // Fungsi untuk menghapus field catatan
    window.removeNoteField = function(element) {
        element.parentNode.parentNode.remove();
    };
});