<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hasilpsikologi extends Model
{
    public $table = "hasilpsikologi";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [

            'siswa_id',
            'nilai',
            'sertifikat',
            'ket',
            'sekolah_id',
    ];
    public function siswa()
        {
            return $this->belongsTo('App\Models\siswa');
        }
        public function sekolah()
        {
            return $this->belongsTo('App\Models\sekolah');
        }
}
