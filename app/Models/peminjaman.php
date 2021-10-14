<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    public $table = "peminjaman";

    use HasFactory;

    protected $fillable = [
        'kodetrans',
        'nama',
        'nomeridentitas',
        'jaminan_nama',
        'jaminan_tipe',
        'tgl_pinjam',
        'tgl_harus_kembali',
        'denda',
    ];
}
