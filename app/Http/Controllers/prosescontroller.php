<?php

namespace App\Http\Controllers;

use App\Exports\exportsekolah;
use App\Imports\importdetailsekolah;
use App\Imports\importsekolah;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class prosescontroller extends Controller
{
	public function exportsekolah()
	{
        $tgl=date("YmdHis");
		return Excel::download(new exportsekolah, 'sekolah-'.$tgl.'.xlsx');
	}
    
	public function importsekolah(Request $request)
	{
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		$file = $request->file('file');

		$nama_file = rand().$file->getClientOriginalName();

		$file->move('file_temp',$nama_file);

		Excel::import(new importsekolah, public_path('/file_temp/'.$nama_file));
        return redirect()->back()->with('status','Data berhasil Diimport!')->with('tipe','success')->with('icon','fas fa-edit');
	}

	public function importdetailsekolah(Request $request)
	{
		// dd($request);
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		$file = $request->file('file');

		$nama_file = rand().$file->getClientOriginalName();

		$file->move('file_temp',$nama_file);

		Excel::import(new importdetailsekolah, public_path('/file_temp/'.$nama_file));
        return redirect()->back()->with('status','Data berhasil Diimport!')->with('tipe','success')->with('icon','fas fa-edit');
	
	}

    
    public function cleartemp()
	{
            $file = new Filesystem;
            $file->cleanDirectory(public_path('file_temp'));

        // unlink(public_path('file_temp'));
        return redirect()->back()->with('status','Data berhasil di Hapus!')->with('tipe','success')->with('icon','fas fa-trash');

    }
}
