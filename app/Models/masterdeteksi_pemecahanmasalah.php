<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use App\Models\walikelas;

class masterdeteksi_pemecahanmasalah extends Model
{
    public $table = "masterdeteksi_pemecahanmasalah";

    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'batasatas',
        'batasbawah',
        'keterangan',
        'masterdeteksi_id',
    ];
    public function masterdeteksi()
    {
        return $this->belongsTo('App\Models\masterdeteksi');
    }
}
