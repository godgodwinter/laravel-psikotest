<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sekolah extends Model
{
    public $table = "sekolah";
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'status',
        'kepsek_nama',
        'kepsek_photo',
        'tahunajaran_nama',
        'semester_nama',
        'sekolah_logo',
        'kecamatan',
        'kabupaten',
        'provinsi',
    ];
    public function yayasandetail()
    {
        return $this->belongsTo('App\Models\yayasandetail');
    }

    public function siswa()
    {
        return $this->hasMany('App\Models\siswa');
    }

    public function walikelas()
    {
        return $this->hasMany('App\Models\walikelas');
    }

    public function gurubk()
    {
        return $this->hasMany('App\Models\gurubk');
    }
    public function kelas()
    {
        return $this->hasMany('App\Models\kelas');
    }
    public function pengguna()
    {
        return $this->hasMany('App\Models\pengguna');
    }
    public function inputnilaipsikologi()
    {
        return $this->hasMany('App\Models\inputnilaipsikologi');
    }
    public function minatbakatdetail()
    {
        return $this->hasMany('App\Models\minatbakatdetail');
    }   
    // this is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($sekolah) {
            $sekolah->siswa()->delete();
        });

        static::deleting(function ($sekolah) {
            $sekolah->walikelas()->delete();
        });

        static::deleting(function ($sekolah) {
            $sekolah->gurubk()->delete();
        });

        static::deleting(function ($sekolah) {
            $sekolah->kelas()->delete();
        });
        static::deleting(function ($sekolah) {
            $sekolah->pengguna()->delete();
        });
        static::deleting(function ($sekolah) {
            $sekolah->inputnilaipsikologi()->delete();
        });
        static::deleting(function ($sekolah) {
            $sekolah->minatbakatdetail()->delete();
        });
        static::deleting(function ($sekolah) {
            $sekolah->yayasandetail()->delete();
        });
    }
}
