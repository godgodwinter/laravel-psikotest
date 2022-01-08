<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class masternilaibidangstudi extends Model
{
        public $table = "masternilaibidangstudi";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'singkatan',
            // 'sekolah_id',
        ];

}
