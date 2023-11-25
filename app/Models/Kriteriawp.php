<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kriteriawp extends Model
{
    use HasFactory;

    protected $table = 'kriteriawp';

    protected $fillable = [
        'id',
        'kode',
        'kriteria',
        'bobot',
        'atribut',
    ];

    public function datawp()
    {
        return $this->hasMany(Datawp::class, 'kriteriawp_id');
    }

}
