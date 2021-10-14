<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengembaliandetail extends Model
{
    public $table = "pengembaliandetail";

    use HasFactory;

    protected $fillable = [
        'kodetrans',
        'nama',
        'nomeridentitas',
        'buku_isbn',
        'buku_nama',
        'buku_kode',
        'buku_penerbit',
        'buku_tahunterbit',
        'buku_pengarang',
        'buku_tempatterbit',
        'buku_bahasa',
        // 'bukurak_kode',
        // 'bukurak_nama',
        'bukukategori_nama',
        'bukukategori_ddc',
        'jaminan_nama',
        'jaminan_tipe',
        'tgl_pinjam',
        'tgl_harus_kembali',
        'tgl_dikembalikan',
        'totaldenda',
    ];
}
