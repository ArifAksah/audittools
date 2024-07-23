<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    protected $table = 'units';
    use HasFactory;
    protected $fillable = ['nama_unit'];

    public function seksis() // pastikan nama fungsi sesuai di blade template
    {
        return $this->hasMany(Seksi::class, 'id_unit');
    }
}
