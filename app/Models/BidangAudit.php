<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangAudit extends Model
{
    use HasFactory;
    protected $table = 'bidang_audit';

    protected $fillable = [
        'bidang_audit',
    ];
}