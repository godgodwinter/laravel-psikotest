<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bukurak extends Model
{
    public $table = "bukurak";

    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
    ];
}
