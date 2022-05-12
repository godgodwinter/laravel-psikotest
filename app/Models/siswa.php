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
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function apiprobk()
    {
        return $this->belongsTo('App\Models\apiprobk');
    }
    public function catatankasussiswa()
    {
        return $this->belongsTo('App\Models\catatankasussiswa');
    }
    public function catatanpengembangandirisiswa()
    {
        return $this->belongsTo('App\Models\catatanpengembangandirisiswa');
    }
    public function catatanprestasisiswa()
    {
        return $this->belongsTo('App\Models\catatanprestasisiswa');
    }
    public function hasilpsikologi()
    {
        return $this->belongsTo('App\Models\hasilpsikologi');
    }
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($sekolah) {
            $sekolah->apiprobk()->delete();
        });
        static::deleting(function ($sekolah) {
            $sekolah->catatankasussiswa()->delete();
        });
        static::deleting(function ($sekolah) {
            $sekolah->catatanpengembangandirisiswa()->delete();
        });
        static::deleting(function ($sekolah) {
            $sekolah->catatanprestasisiswa()->delete();
        });
        static::deleting(function ($sekolah) {
            $sekolah->hasilpsikologi()->delete();
        });
    }
}
