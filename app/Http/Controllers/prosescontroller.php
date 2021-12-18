<?php

namespace App\Http\Controllers;

use App\Exports\exportdetailsekolah;
use App\Exports\exportsekolah;
use App\Imports\importdetailsekolah;
use App\Imports\importsekolah;
use App\Models\sekolah;
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

	public function importdetailsekolah(sekolah $id,Request $request)
	{
		// dd($request,$id->id);
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		$file = $request->file('file');

		$nama_file = rand().$file->getClientOriginalName();

		$file->move('file_temp',$nama_file);

		Excel::import(new importdetailsekolah($id->id), public_path('/file_temp/'.$nama_file));

        return redirect()->back()->with('status','Data berhasil Diimport!')->with('tipe','success')->with('icon','fas fa-edit');

	}


    public function cleartemp()
	{
            $file = new Filesystem;
            $file->cleanDirectory(public_path('file_temp'));

        // unlink(public_path('file_temp'));
        return redirect()->back()->with('status','Data berhasil di Hapus!')->with('tipe','success')->with('icon','fas fa-trash');

    }

    public function exportdetailsekolah(sekolah $id,Request $request){
        // dd($request);
        $tgl=date("YmdHis");
		return Excel::download(new exportdetailsekolah($id), 'psikotest-detailsekolah-'.$id->id.'-'.$tgl.'.xlsx');
    }

    public function sinkronujian(Request $request){
        $data = array(
            'username' => 'RAHASIA'
         );

        $client = new \GuzzleHttp\Client();
$response = $client->request('POST', 'http://161.97.84.91:9001/api/probk/DataSertifikat_Get', [
    'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
    'body'    => json_encode($data)
]
);

echo $response->getStatusCode(); // 200
echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'

        dd('asdasd');

    }
}
