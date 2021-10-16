<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\walikelas;

class kelas extends Model
{
        public $table = "kelas";

        use HasFactory;

        protected $fillable = [
            'nama',
            'walikelas_id',
            'tipe',
            'sekolah_id'
        ];

        public function walikelas()
        {
            return $this->belongsTo('App\Models\walikelas');
        }
}
