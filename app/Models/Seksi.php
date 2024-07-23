<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seksi extends Model
{
    use HasFactory;
    protected $table = 'seksi';
    protected $fillable = ['id_unit', 'nama_seksi'];

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'id_unit');
    }
}
