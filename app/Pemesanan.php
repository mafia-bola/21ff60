<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesanan extends Model
{
    use SoftDeletes;

    protected $table = 'pemesanan';
    protected $guarded = [];
    
    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function kecak()
    {
        return $this->hasOne(Kecak::class);
    }

    public function pengunjung()
    {
        return $this->hasMany(Pengunjung::class);
    }
}
