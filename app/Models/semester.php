<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class semester extends Model
{
        public $table = "semester";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'sekolah_id'
        ];
}
