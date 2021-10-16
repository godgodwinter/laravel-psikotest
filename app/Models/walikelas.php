<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class walikelas extends Model
{
        public $table = "walikelas";

        use HasFactory;

        protected $fillable = [
            'nama',
            'nomerinduk',
            'sekolah_id'
        ];


    public function kelas()
    {
        return $this->hasOne('App\Models\kelas');
    }
}
