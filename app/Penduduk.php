<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    protected $table = 'penduduk';

    protected $guarded = [];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
