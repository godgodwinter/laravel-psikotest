<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class siswa extends Model
{
        public $table = "siswa";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'nomerinduk',
        ];

        public function kelas()
        {
            return $this->belongsTo('App\Models\kelas');
        }
}
