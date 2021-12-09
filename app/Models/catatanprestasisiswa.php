<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class catatanprestasisiswa extends Model
{
    public $table = "catatanprestasisiswa";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'siswa_id',
            // 'kelas_id',
            'tanggal',
            'prestasi',
            'teknikbelajar',
            'saranabelajar',
            'penunjangbelajar',
            'kesimpulandansaran',
            'sekolah_id',
        ];
        // public function kelas()
        // {
        //     return $this->belongsTo('App\Models\kelas');
        // }
        public function siswa()
        {
            return $this->belongsTo('App\Models\siswa');
        }
}
