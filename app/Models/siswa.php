<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class siswa extends Model
{
        public $table = "siswa";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'nama',
            'nomerinduk',
            'apiprobk_id',
            'apiprobk_username',
            'users_id',
            'sekolah_id',
            'kelas_id',
        ];

        public function kelas()
        {
            return $this->belongsTo('App\Models\kelas');
        }
        public function sekolah()
        {
            return $this->belongsTo('App\Models\sekolah');
        }
}
