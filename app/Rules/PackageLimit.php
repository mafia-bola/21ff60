<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Desa;
use App\User;
use App\Kegiatan;

class PackageLimit implements Rule
{
    public $class;
    public $column;
    public $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($class,$column_name,$desa_id)
    {
        $this->class = $class;
        $this->column = $column_name;
        $this->id = $desa_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $desa = Desa::find($this->id);
        if($this->class == 'User'){
            $total = User::where('desa_id',$this->id)
                ->whereIn('role',['Kepala Desa','Petugas'])
                ->get()
                ->count();
        }elseif($this->class == 'Kegiatan'){
            $total = Kegiatan::where('desa_id',$this->id)
                ->count();
        }
        return $total < $desa->{$this->column};
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Jumlah sudah melebihi paket, silakan hubungi administrator';
    }
}
