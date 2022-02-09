<?php

namespace App\Exports;

use App\Helpers\Fungsi;
use App\Models\kelas;
use App\Models\minatbakat;
use App\Models\minatbakatdetail;
use App\Models\siswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class exportkelas implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id;

    function __construct($id,$data) {
           $this->id = $id;
           $this->data = $data;
    }

    public function headings(): array
    {

        // $master=minatbakat::where('kategori','Minat dan Bakat')
        // ->orderBy('id','asc')
        // ->get();
        $arr=['Nomer Induk','Nama','Username','Password'];

        return $arr;
    }
    public function collection()
    {
        $datas=siswa::with('users')
        ->where('siswa.sekolah_id',$this->id->id)
        ->select('siswa.nomerinduk','siswa.nama','users.username','siswa.passworddefault')
        ->join('users', 'users.id', '=', 'siswa.users_id')
        ->where('siswa.kelas_id',$this->data->id)
        ->orderBy('nama','asc')
        ->get();
        // dd($this->id,$datas);

        return $datas;
        }
}
