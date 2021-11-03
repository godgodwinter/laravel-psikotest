<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class minatbakat extends Model
{
        public $table = "minatbakat";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'kategori',
            'menukhusus',
        ];

}
