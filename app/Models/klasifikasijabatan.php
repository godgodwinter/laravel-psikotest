<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class klasifikasijabatan extends Model
{
        public $table = "klasifikasijabatan";

        use SoftDeletes;
        use HasFactory;

        protected $fillable = [
            'bidang',
            'akademis',
            'pekerjaan',
            'nilaistandart',
            'iqstandart',
            'jurusan',
            'bidangstudi',
            'ket',
            // 'sekolah_id'
        ];

}
