<?php

namespace App\Http\Controllers;

use App\Models\settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminsettingscontroller extends Controller
{
    public function index(){
        $datas=DB::table('settings')->where('id',1)->first();
        return view('pages.admin.settings.index',compact('datas'));
    }
    public function update(settings $id,Request $request){
        // dd($request,$id);
        settings::where('id',$id->id)
        ->update([
            'app_nama' => $request->app_nama,
            'app_namapendek' => $request->app_namapendek,
            'paginationjml' => $request->paginationjml,
           'updated_at'=>date("Y-m-d H:i:s")
        ]);
        return redirect()->route('settings')->with('status','Data berhasil diubah!')->with('tipe','success');
    }
}
