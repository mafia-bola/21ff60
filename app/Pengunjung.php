<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengunjung extends Model
{
    use Notifiable;
    use SoftDeletes;
    
    protected $table = 'pengunjung';
    protected $guard = 'pengunjung';

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
