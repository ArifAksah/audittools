<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notesGM extends Model
{
    use HasFactory;
    protected $table = 'notesgm';

    protected $fillable = [
        'id_audit',
        'id_lhap',
        'id_auditor',
        'status',
        'audit_kka',
        'notes',
        'auditor_lhap'
    ];
}
