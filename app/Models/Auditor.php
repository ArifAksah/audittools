<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_audit',
        'nama',
        'jabatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan model Audit
    public function audit()
    {
        return $this->belongsTo(Audit::class, 'id_audit');
    }
}
