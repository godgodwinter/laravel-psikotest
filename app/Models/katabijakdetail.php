<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class katabijakdetail extends Model
{
        public $table = "katabijakdetail";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            
            'penjelasan',
            'judul',
            
        ];
        public function katabijak()
        {
            return $this->belongsTo('App\Models\katabijak');
        }

}
