<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahun extends Model
{
        public $table = "tahun";

        use HasFactory;
    
        protected $fillable = [
            'nama',
            'sekolah_id'
        ];
}
