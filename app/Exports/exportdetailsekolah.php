<?php

namespace App\Exports;

use App\Helpers\Fungsi;
use App\Models\kelas;
use App\Models\masternilaipsikologi;
use App\Models\minatbakat;
use App\Models\minatbakatdetail;
use App\Models\siswa;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class exportdetailsekolah implements FromCollection, WithHeadings, ShouldAutoSize
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

        $master=masternilaipsikologi::orderBy('id','asc')
        ->get();
        $arr=['NO','KELAS','NOINDUK','Nama','JK','UMUR'];
        foreach($master as $m){
            array_push($arr,$m->nama);
        }

        $master2=minatbakat::orderBy('id','asc')
        ->get();

        foreach($master2 as $m){
            array_push($arr,$m->nama);
        }

        // dd($arr);

        return $arr;
    }
    public function collection()
    {
        // $kelaspertama=kelas::where('sekolah_id',$this->id->id)->first();
        // if($kelaspertama!=null){
        //     $kelas_id=$kelaspertama->id;
        // }else{
        //     $kelas_id=0;
        // }
        $datas=siswa::with('kelas')
        ->where('sekolah_id',$this->id->id)
        // ->where('kelas_id',$kelas_id)
        ->whereNull('deleted_at')->where('sekolah_id',$this->id->id)
        ->orderBy('nama','asc')
        ->get();
        // dd($datas);

        $dataakhir = collect();

        $dataakhir_array = $dataakhir->toArray();

        // $master=minatbakat::where('kategori','Minat dan Bakat')
        // ->orderBy('id','asc')
        // ->get();

            $collectionpenilaian = new Collection();
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
                $d->kelas!=null?$d->kelas->nama:null
            );

            array_push($arr,
                $d->nomerinduk
            );


            array_push($arr,
                $d->nama
            );


            array_push($arr,
                $d->jk
            );

            array_push($arr,
                $d->umur
            );

        $master=masternilaipsikologi::orderBy('id','asc')
        ->get();

            foreach($master as $m){


                // $periksadata=DB::table('minatbakatdetail')
                // ->where('siswa_id',$d->id)
                // // ->where('id','2')
                // ->where('minatbakat_id',$m->id)
                // ->get();


                $periksadata=DB::table('inputnilaipsikologi')
                ->where('siswa_id',$d->id)
                // ->where('id','2')
                ->where('masternilaipsikologi_id',$m->id)
                ->get();

                if($periksadata->count()>0){
                    $ambildata=$periksadata->first();
                    $nilai=$periksadata->first()->nilai;
                }else{
                    $nilai=null;
                }

                array_push($arr,$nilai);
            // dd($arr, $m->nama,$nilai);

            }


            $master=minatbakat::orderBy('id','asc')
            ->get();

                foreach($master as $m){


                    // $periksadata=DB::table('minatbakatdetail')
                    // ->where('siswa_id',$d->id)
                    // // ->where('id','2')
                    // ->where('minatbakat_id',$m->id)
                    // ->get();


                    $periksadata=DB::table('minatbakatdetail')
                    ->where('siswa_id',$d->id)
                    // ->where('id','2')
                    ->where('minatbakat_id',$m->id)
                    ->get();

                    if($periksadata->count()>0){
                        $ambildata=$periksadata->first();
                        $nilai=$periksadata->first()->nilai;
                    }else{
                        $nilai=null;
                    }

                    array_push($arr,$nilai);
                // dd($arr, $m->nama,$nilai);

                }
                $collectionpenilaian->push((object)$arr);


            }

            // dd('testing',$datas,$collectionpenilaian);

        return $collectionpenilaian;
        }
}
