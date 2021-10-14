<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    public $table = "settings";

    use HasFactory;

    protected $fillable = [
        'paginationjml',
        'sekolahnama',
        'sekolahalamat',
        'sekolahtelp',
        'aplikasijudul',
        'aplikasijudulsingkat',
        'defaultdenda',
        'defaultminbayar',
        'defaultmaxbukupinjam',
        'defaultmaxharipinjam',
        'passdefaultpegawai',
        'passdefaultadmin',
        'sekolahlogo',
        'sekolahttd',
        'sekolahttd2',
    ];
}
