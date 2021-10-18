<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class inputnilaipsikologi extends Model
{
        public $table = "inputnilaipsikologi";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'siswa_id',
            'masternilaipsikologi_id',
            'nilai',
            'sekolah_id',
        ];

}
