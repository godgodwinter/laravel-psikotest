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
}
