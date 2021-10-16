<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class tahun extends Model
{
        public $table = "tahun";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'sekolah_id'
        ];
}
