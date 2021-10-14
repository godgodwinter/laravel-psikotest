<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    public $table = "settings";

    use HasFactory;

    protected $fillable = [
        'app_nama',
        'app_namapendek',
        'paginationjml',
    ];
}
