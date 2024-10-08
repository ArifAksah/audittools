<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;
    protected $table = 'signatures';

    protected $fillable = [
        'id_audit',
        'id_user',
        'name',
        'signature',
    ];

}
