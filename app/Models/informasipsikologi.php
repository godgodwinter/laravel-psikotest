<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class informasipsikologi extends Model
{
        public $table = "informasipsikologi";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'tipe',
            'link',
            'file',
        ];

}
