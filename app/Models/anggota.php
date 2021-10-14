<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class anggota extends Model
{
    public $table = "anggota";

    use HasFactory;

    protected $fillable = [
        'nama',
        'nomeridentitas',
        'agama',
        'tempatlahir',
        'tgllahir',
        'alamat',
        'jk',
        'tipe',
        'sekolahasal',
        'telp',
    ];
}
