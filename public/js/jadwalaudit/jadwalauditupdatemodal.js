$(document).ready(function() {
    $('.update-btn').click(function() {
        var jadwalAuditId = $(this).data('id');
        $('#id_audit' + jadwalAuditId).val($(this).data('id_audit'));
        $('#nama_kegiatan' + jadwalAuditId).val($(this).data('nama_kegiatan'));
        $('#mulai' + jadwalAuditId).val($(this).data('mulai'));
        $('#selesai' + jadwalAuditId).val($(this).data('selesai'));
    });
});