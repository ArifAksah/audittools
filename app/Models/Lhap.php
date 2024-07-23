<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lhap extends Model
{
    use HasFactory;
    protected $table = 'lhap';

    protected $fillable = [
        'id_kka',
        'id_user',
        'nama_ketuatim',
        'nama_pengawas',
        'auditor_kka',
        'audit_kka',
        'nomor_kka',
        'kondisi_teks',
        'kondisi_image',
        'kriteria_teks',
        'kriteria_image',
        'sebab',
        'akibat',
        'rekomendasi',
        'evidence',
        'dibuat_oleh',
        'update_terakhir_tanggal',
    ];
    protected $casts = [
        'kondisi_image' => 'array',
        'kriteria_image' => 'array',
        'rekomendasi' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
    public function audits()
    {
        return $this->hasMany(Audit::class, 'id_lhap', 'id');
    }
}
