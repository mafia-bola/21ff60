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
<<<<<<< HEAD
        return $this->hasMany(Kecak::class);
=======
        return $this->hasOne(Kecak::class);
>>>>>>> 9b8280e170758c7b11ea35e21179e04f362ac87d
    }

    public function pengunjung()
    {
        return $this->hasMany(Pengunjung::class);
    }
}
