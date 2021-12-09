<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class catatankasussiswa extends Model
{
    public $table = "catatankasussiswa";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [

            'siswa_id',
            // 'kelas_id',
            'kasus',
            'tanggal',
            'pengambilandata',
            'sumberkasus',
            'golkasus',
            'penyebabtimbulkasus',
            'teknikkonseling',
            'keberhasilanpenanganankasus',
            'keterangan',
            'sekolah_id',
    ];
    // public function kelas()
    //     {
    //         return $this->belongsTo('App\Models\kelas');
    //     }
        public function siswa()
        {
            return $this->belongsTo('App\Models\siswa');
        }
}
