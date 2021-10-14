<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peralatan extends Model
{
    public $table = "peralatan";

    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori_nama',
        'tgl_masuk',
        'kondisi',
    ];
}
