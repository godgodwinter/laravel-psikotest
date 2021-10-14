<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    public $table = "buku";

    use HasFactory;

    protected $fillable = [
        'nama',
        'isbn',
        'penerbit',
        'tahunterbit',
        'pengarang',
        'tempatterbit',
        'bahasa',
        'kode',
        // 'bukurak_nama',
        // 'bukurak_kode',
        'bukukategori_nama',
        'bukukategori_ddc',
    ];

    protected $appends = ['code'];

    public function getCodeAttribute()
{
    // use $this->attributes['id'] or try with $this->id
    return str_pad($this->attributes['id'], 6, "0", STR_PAD_LEFT);
}
}
