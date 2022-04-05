<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class penjelasan_faktorkepribadian extends Model
{
        public $table = "penjelasan_faktorkepribadian";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'namakarakter',
            'pemahaman',
            'pembiasaansikap',
            'tujuandanmanfaat',
            'tipekarakter',
        ];

}
