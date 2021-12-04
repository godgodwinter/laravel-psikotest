<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class catatanpengembangandirisiswa extends Model
{
    public $table = "catatanpengembangandirisiswa";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [

        'siswa_id',
        // 'kelas_id',
        'tanggal',
        'idedanimajinasi',
        'ketrampilan',
        'kreatif',
        'organisasi',
        'kelanjutanstudi',
        'hobi',
        'citacita',
        'kemampuankhusus',
        'keterangan',
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

