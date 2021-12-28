<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class apiprobk_deteksi extends Model
{
    public $table = "apiprobk_deteksi";
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'apiprobk_id',
        'kunci',
        'isi',
    ];
}
