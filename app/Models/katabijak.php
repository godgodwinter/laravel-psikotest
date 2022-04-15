<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class katabijak extends Model
{
    public $table = "katabijak";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'judul',
        'status',
    ];
    public function katabijakdetail()
    {
        return $this->hasMany('App\Models\katabijakdetail');
    }
}
