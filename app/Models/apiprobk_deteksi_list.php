<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class apiprobk_deteksi_list extends Model
{
    public $table = "apiprobk_deteksi_list";
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nama',
        'score',
        'keterangan',
        'rank',
        'apiprobk_id',
    ];
}
