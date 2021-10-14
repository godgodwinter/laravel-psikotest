<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengunjung extends Model
{
    public $table = "pengunjung";

    use HasFactory;

    protected $fillable = [
        'nama',
        'nomeridentitas',
        'tipe',
        'tgl',
    ];
}
