<?php

namespace App\Exports;

use App\Helpers\Fungsi;
use App\Models\hasilpsikologi;
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

class exporthasilpsikologi implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id;

    function __construct($id,) {
           $this->id = $id;
    }

    public function headings(): array
    {

        $arr=['No','Nomer Induk','Nama','Nilai'];

        return $arr;
    }
    public function collection()
    {
        $datas=hasilpsikologi::with('siswa')->where('sekolah_id',$this->id->id)
        ->orderBy('id','asc')
        ->get();

        $dataakhir = collect();


            $collection = new Collection();
        $nomer=1;
        foreach($datas as $d){
            $arr=[];
            // $nomer++;
            // dd($datas);
            array_push($arr,
                $nomer
            );
            $nomer++;

            array_push($arr,
                $d->siswa->nomerinduk
            );
            array_push($arr,
                $d->siswa->nama
            );

            array_push($arr,
                $d->nilai
            );
            $collection->push((object)$arr);

            $nomer++;

            }

            // dd('testing',$collection);

        return $collection;
        }
}
