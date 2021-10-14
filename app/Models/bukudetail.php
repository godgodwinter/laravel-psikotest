<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bukudetail extends Model
{
    public $table = "bukudetail";

    use HasFactory;

    protected $fillable = [
        'buku_nama',
        'buku_kode',
        'buku_isbn',
        'buku_penerbit',
        'buku_tahunterbit',
        'buku_bahasa',
        'buku_kode',
        'buku_pengarang',
        'buku_tempatterbit',
        // 'bukurak_nama',
        // 'bukurak_kode',
        'bukukategori_nama',
        'bukukategori_ddc',
        'status',
    ];
}
