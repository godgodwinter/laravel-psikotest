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
}
