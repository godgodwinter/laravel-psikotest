<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class admininputnilaipsikologicontroller extends Controller
{
    public function index(Request $request,sekolah $id)
    {
        $pages='inputnilaipsikologi';
        $datas=DB::table('siswa')->whereNull('deleted_at')->where('sekolah_id',$id->id)
        ->orderBy('id','asc')
        ->get();

        $product = collect([
            [
                'name' => 'John Doe',
                'department' => 'Sales',
            ],
            [
                'name' => 'Jane Doe',
                'department' => 'Sales',
            ],
            [
                'name' => 'Johnny Doe',
                'department' => 'Marketing',
            ]
        ]);

        $buy_number = array('buynumber' => 0);
        $product_array = $product->toArray();
        $product->key = 'value';
                
        // dd($product,$product_array);
        array_map(function($product) use($buy_number) {
            return array_merge($product, $buy_number);}, 
        $product_array);

        $product_array['buynumber'] = $buy_number;

        foreach($product as $p){
            // $p;
            // dd($p);
            $p['indexname'] = 'asdad';
            // dd($p);
            
        }

        $array = [1, 2, 3, 4, 5];
        function multipleFive($array){
            $newArray = [];
            foreach($array as $a){
                $newArray[] = $a * 5;
            }
            return $newArray;
        }
        
        $array = multipleFive($array);


        
        dd($datas,$product,$product_array,$array);
        return view('pages.admin.sekolah.pages.inputnilaipsikologi.index',compact('pages','request','datas','id'));
    }
}
