<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alternatifwp extends Model
{
    use HasFactory;

    protected $table = 'alternatifwp';

    protected $fillable = [
        'id',
        'kode',
        'nama',
        'keterangan',
    ];

    public function datawp()
    {
        return $this->hasMany(Datawp::class, 'alternatifwp_id');
    }
}
