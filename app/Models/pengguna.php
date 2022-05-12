<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pengguna extends Model
{
    public $table = "pengguna";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'nama',
        'users_id',
        'sekolah_id',
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
