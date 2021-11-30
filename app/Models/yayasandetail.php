<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class yayasandetail extends Model
{
    public $table = "yayasandetail";
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'yayasan_id',
        'sekolah_id',
        'status',
    ];
}
