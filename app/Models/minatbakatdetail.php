<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class minatbakatdetail extends Model
{
        public $table = "minatbakatdetail";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'minatbakat_id',
            'siswa_id',
            'nilai',
            'sekolah_id',
        ];

}
