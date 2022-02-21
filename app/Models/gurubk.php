<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gurubk extends Model
{
        public $table = "gurubk";

        use HasFactory;

        protected $fillable = [
            'nama',
            'nomerinduk',
            'sekolah_id'
        ];


    // public function kelas()
    // {
    //     return $this->belongsTo('App\Models\kelas');
    // }
}
