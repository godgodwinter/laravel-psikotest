<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class yayasan extends Model
{
    public $table = "yayasan";
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nama',
        'kepala',
        'alamat',
        'telp',
        'status',
        'users_id',
        'kepala_photo',
        'yayasan_photo',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
