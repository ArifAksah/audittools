<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KkaInformation extends Model
{
    use HasFactory;

    protected $table = 'kka_informations'; 

    protected $fillable = [
        'id_audit',
        'id_user',
        'auditor_kka',
        'audit_kka',
        'kondisi_teks',
        'kondisi_image',
        'kriteria_teks',
        'kriteria_image',
        'sebab',
        'akibat',
        'rekomendasi',
        'evidence',
        'dibuat_oleh',
        'update_terakhir_tanggal'
    ];

    // Relasi dengan model Audit
    public function audit()
    {
        return $this->belongsTo(Audit::class, 'id_audit');
    }

    // Relasi dengan model User (pembuat KKA)
    public function creator()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
