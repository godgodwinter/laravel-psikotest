<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class referensi extends Model
{
        public $table = "referensi";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'tipe',
            'link',
            'file',
            'sekolah_id'
        ];

}
