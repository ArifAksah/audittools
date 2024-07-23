<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;
    protected $fillable = [
        'nomor_surat',
        'judul_audit',
        'bidang_audit',
        'mulai',
        'selesai',
    ];
    // Di dalam model Audit
    public function auditors()
    {
        return $this->hasMany(Auditor::class, 'id_audit', 'id');
    }
    // Definisikan relasi dengan model Lhap
    public function lhap()
    {
        return $this->hasMany(Lhap::class, 'id_audit');
    }
}
