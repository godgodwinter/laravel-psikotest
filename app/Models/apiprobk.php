<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class apiprobk extends Model
{
    public $table = "apiprobk";
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'username',
        'sertifikat',
        'sertifikat_tgl',
        'deteksi',
        'deteksi_tgl',
    ];
    public function apiprobk_deteksi()
    {
        return $this->belongsTo('App\Models\apiprobk_deteksi');
    }
    public function apiprobk_deteksi_list()
    {
        return $this->belongsTo('App\Models\apiprobk_deteksi_list');
    }
    public function apiprobk_sertifikat()
    {
        return $this->belongsTo('App\Models\apiprobk_sertifikat');
    }
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($sekolah) {
            $sekolah->apiprobk_deteksi_list()->delete();
        });
        static::deleting(function ($sekolah) {
            $sekolah->apiprobk_deteksi()->delete();
        });
        static::deleting(function ($sekolah) {
            $sekolah->apiprobk_sertifikat()->delete();
        });
    }
}
