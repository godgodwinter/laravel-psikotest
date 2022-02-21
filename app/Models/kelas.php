<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class kelas extends Model
{
        public $table = "kelas";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'walikelas_id',
            'gurubk_id',
            // 'tipe',
            'sekolah_id'
        ];

        public function walikelas()
        {
            return $this->belongsTo('App\Models\walikelas');
        }
        public function gurubk()
        {
            return $this->belongsTo('App\Models\gurubk');
        }
}
