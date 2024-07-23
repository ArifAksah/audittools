<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAuditSP2A extends Model
{
    use HasFactory;
    protected $table = 'jadwalauditsp2a'; 
    protected $fillable = [
        'id_audit',
        'nama_kegiatan',
        'mulai',
        'selesai',
        'upload_dokumen',
    ];

    public function audit()
    {
        return $this->belongsTo(Audit::class, 'id_audit');
    }
}
