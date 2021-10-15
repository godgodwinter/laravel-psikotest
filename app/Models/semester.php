<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class semester extends Model
{
        public $table = "semester";

        use HasFactory;
    
        protected $fillable = [
            'nama',
            'sekolah_id'
        ];
}
