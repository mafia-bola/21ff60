<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecak extends Model
{
    use SoftDeletes;
    
    protected $table = 'kecak';
    protected $guarded = [];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
