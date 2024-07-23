<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParafKetuaTim extends Model
{
    use HasFactory;

    protected $table = 'paraf_ketua_tim';

    protected $fillable = [
        'id_audit',
        'id_user',
        'signature',
    ];

    // Relationship dengan model Audit
    public function audit()
    {
        return $this->belongsTo(Audit::class, 'id_audit');
    }

    // Relationship dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
