<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bukudigital extends Model
{
    public $table = "bukudigital";

    use HasFactory;

    protected $fillable = [
        'nama',
        'tipe',
        'link',
        'gambar',
        'ket',
        'file',
    ];

    protected $appends = ['code'];

    public function getCodeAttribute()
{
    // use $this->attributes['id'] or try with $this->id
    return str_pad($this->attributes['id'], 6, "0", STR_PAD_LEFT);
}
}
