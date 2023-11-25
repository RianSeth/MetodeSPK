<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datawp extends Model
{
    use HasFactory;

    protected $table = 'datawp';

    protected $fillable = [
        'id',
        'kriteriawp_id',
        'alternatifwp_id',
        'value',
    ];

    public function kriteriawp()
    {
        return $this->belongsTo(Kriteriawp::class);
    }

    public function alternatifwp()
    {
        return $this->belongsTo(Alternatifwp::class);
    }
}
