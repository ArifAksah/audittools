<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notesKetuaTim extends Model
{
    use HasFactory;
    protected $table = 'notesketuatim';

    protected $fillable = [
        'id_audit',
        'id_lhap',
        'id_auditor',
        'status',
        'audit_kka',
        'nama_pengawas',
        'nama_ketuatim',
        'notes',
        'auditor_lhap'
    ];
}
