<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audity extends Model
{
    use HasFactory;
    protected $table = 'audity';

    protected $fillable = [
        'id_audit',
        'departemen',
        // Tambahkan nama kolom lainnya yang ingin Anda isikan secara massal
    ];
}
