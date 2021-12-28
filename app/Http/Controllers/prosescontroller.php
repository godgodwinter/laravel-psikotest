<?php

namespace App\Http\Controllers;

use App\Exports\exportdetailsekolah;
use App\Exports\exportsekolah;
use App\Imports\importdetailsekolah;
use App\Imports\importsekolah;
use App\Imports\importusername;
use App\Models\apiprobk;
use App\Models\apiprobk_deteksi;
use App\Models\apiprobk_sertifikat;
use App\Models\inputnilaipsikologi;
use App\Models\kelas;
use App\Models\masternilaipsikologi;
use App\Models\minatbakat;
use App\Models\minatbakatdetail;
use App\Models\sekolah;
use App\Models\siswa;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

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

	public function importusername(sekolah $id,Request $request)
	{
		// dd($request,$id->id);
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		$file = $request->file('file');

		$nama_file = rand().$file->getClientOriginalName();

		$file->move('file_temp',$nama_file);

		Excel::import(new importusername($id->id), public_path('/file_temp/'.$nama_file));

        return redirect()->back()->with('status','Data berhasil Diimport!')->with('tipe','success')->with('icon','fas fa-edit');

	}

	public function backuptemp(Request $request)
	{
        ini_set('max_execution_time', 3000);
        $replace=$request->replace;
        $insertsekolah=$request->insertsekolah;
        $insertsiswa=$request->insertsiswa;



        //deteksi
        //ambil apiprobk where deteksi == belum
        $datas=apiprobk::where('deteksi','!=','sudah')->get();
        // dd($datas);
        foreach($datas as $data){
        // dd('tes');
            $username = array(
                'username' => $data->username
             );


            $client = new \GuzzleHttp\Client();
            $responsedeteksi = $client->request('POST', 'http://161.97.84.91:9001/api/probk/DataDeteksi_Get', [
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                'body'    => json_encode($username),
                'allow_redirects' => true,
                'timeout' => 2000,
                'http_errors' => false
            ]
            );

            $hasildeteksi=json_decode($responsedeteksi->getBody());
            // dd($hasildeteksi->deteksi_list);
            //backup deteksi
            $itemscount=apiprobk_deteksi::where('apiprobk_id',$data->id)->count();
                if($itemscount<1){
                    // dd('insert');

                        foreach($hasildeteksi as $key => $value){
                            //simpan apiprobk_deteksi
                            if($key!='deteksi_list'){
                                //insert all
                                DB::table('apiprobk_deteksi')->insert(
                                    array(
                                        'apiprobk_id'     =>  $data->id,
                                        'kunci'     =>   $key,
                                        'isi'     =>   $value,
                                        'deleted_at' => null,
                                        'created_at'=>date("Y-m-d H:i:s"),
                                        'updated_at'=>date("Y-m-d H:i:s")
                                    ));

                            }else{
                                //deteksilist
                                foreach($hasildeteksi->deteksi_list as $item){
                                    //insert deteksi list where apiprobk_id

                                    // dd($item->deteksi_nama);
                                DB::table('apiprobk_deteksi_list')->insert(
                                    array(
                                        'apiprobk_id'     =>  $data->id,
                                        'nama'     =>   $item->deteksi_nama,
                                        'score'     =>   $item->deteksi_score,
                                        'keterangan'  =>   $item->deteksi_keterangan,
                                        'rank'     =>   $item->deteksi_rank,
                                        'deleted_at' => null,
                                        'created_at'=>date("Y-m-d H:i:s"),
                                        'updated_at'=>date("Y-m-d H:i:s")
                                    ));
                                }
                            }
                        // dd($hasil,$key,$value);
                        }
                }else{
                    // dd('update');
                }


        // echo $response->getStatusCode(); // 200
        // dd($responsedeteksi->getStatusCode());
        if($responsedeteksi->getStatusCode()==200){
              apiprobk::where('id',$data->id)
                ->update([
                    'deteksi'     =>   'sudah',
                   'updated_at'=>date("Y-m-d H:i:s")
                ]);
        }else{
            apiprobk::where('id',$data->id)
              ->update([
                  'deteksi'     =>   'gagal',
                 'updated_at'=>date("Y-m-d H:i:s")
              ]);
        }

        }


		// dd($replace);
        //sertifikat
        //ambil apiprobk where sertifikat == belum
        $datas=apiprobk::where('sertifikat','!=','sudah')->get();
        // dd($datas);
        foreach($datas as $data){

        $username = array(
            'username' => $data->username
         );


        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'http://161.97.84.91:9001/api/probk/DataSertifikat_Get', [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($username),
            'allow_redirects' => true,
            'timeout' => 2000,
            'http_errors' => false
        ]
        );

        // echo $response->getStatusCode(); // 200
        // echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
        // echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
        $hasil=json_decode($response->getBody());
        // dd($hasil);
            // dd($hasil->nama);

    //backup sertifikat
    $itemscount=apiprobk_sertifikat::where('apiprobk_id',$data->id)->count();
        if($itemscount<1){
            // dd('insert');

                foreach($hasil as $key => $value){
                    //simpan apiprobk_sertifikat
                        //insert all
                        DB::table('apiprobk_sertifikat')->insert(
                            array(
                                'apiprobk_id'     =>  $data->id,
                                'kunci'     =>   $key,
                                'isi'     =>   $value,
                                'deleted_at' => null,
                                'created_at'=>date("Y-m-d H:i:s"),
                                'updated_at'=>date("Y-m-d H:i:s")
                            ));
                // dd($hasil,$key,$value);


                }
        }else{
            // dd('update');
        }

        if($response->getStatusCode()==200){
            apiprobk::where('id',$data->id)
              ->update([
                  'sertifikat'     =>   'sudah',
                 'updated_at'=>date("Y-m-d H:i:s")
              ]);
      }else{
          apiprobk::where('id',$data->id)
            ->update([
                'sertifikat'     =>   'gagal',
               'updated_at'=>date("Y-m-d H:i:s")
            ]);
      }
        //end apiprobk (username)
    }


        return redirect()->route('detailsekolah.sinkronapiprobk')->with('status','Data berhasil Diimport!')->with('tipe','success')->with('icon','fas fa-edit');

	}

    public function apitesting(){

        // $username = array(
        //     'username' => '1VU6X-8WNPR-0B3MA'
        //  );
        // $client = new \GuzzleHttp\Client();
        // $response = $client->request('POST', 'http://161.97.84.91:9001/api/probk/DataSertifikat_Get', [
        //     'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        //     'body'    => json_encode($username),
        //     'allow_redirects' => true,
        //     'timeout' => 2000,
        //     'http_errors' => false
        // ]
        // );

        // // echo $response->getStatusCode(); // 200
        // // echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
        // // echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'
        // $hasil=json_decode($response->getBody());
// $ch = curl_init("http://google.com");    // initialize curl handle
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// $data = curl_exec($ch);
// print($data);
        // dd($hasil);

//         $curlHandler = curl_init();

// curl_setopt_array($curlHandler, [
//     CURLOPT_URL => 'https://postman-echo.com/post',
//     CURLOPT_RETURNTRANSFER => true,

//     /**
//      * Specify POST method
//      */
//     CURLOPT_POST => true,

//     /**
//      * Specify request content
//      */
//     CURLOPT_POSTFIELDS => 'POST raw request content',
// ]);

// $response = curl_exec($curlHandler);

// curl_close($curlHandler);

// echo($response);

$httpClient = new Client();

// $response = $httpClient->post(
//     'https://postman-echo.com/post',
//     [
//         RequestOptions::BODY => 'POST raw request content',
//         RequestOptions::HEADERS => [
//             'Content-Type' => 'application/x-www-form-urlencoded',
//         ],
//     ]
// );
$response = $httpClient->post(
    'http://161.97.84.91:9001/api/probk/DataSertifikat_Get',
    [
        RequestOptions::BODY => 'POST raw request content',
        RequestOptions::HEADERS => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ],
    ]
);

// $client = new \GuzzleHttp\Client();
// $response = $client->request('POST', 'http://161.97.84.91:9001/api/probk/DataSertifikat_Get', [
//     'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
//     'body'    => json_encode($username),
//     'allow_redirects' => true,
//     'timeout' => 2000,
//     'http_errors' => false
// ]
// );

echo(
    $response->getBody()->getContents()
);
    }
    public function sinkronapiprobk(){

        ini_set('max_execution_time', 3000);
        // 1.ambil data apiprobk
        $getdatas=apiprobk::get();
        foreach($getdatas as $data){

        // 2. periksa jika deteksi==belum maka sinkron

        // 3. periksa jika sertifikat==belum maka sinkron



        $getapi=apiprobk_deteksi::where('kunci','sekolah')->where('apiprobk_id',$data->id)->first();
        // dd($getapiprobk_sertifikat->isi);
        $namasekolah=$getapi->isi;
        //1. Periksa sekolah ada?
            $periksasekolah=sekolah::where('nama',$namasekolah)->count();
            if($periksasekolah<1){
                DB::table('sekolah')->insert(
                    array(
                        'nama'     =>  $namasekolah,
                        'status'     =>   'Aktif',
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ));

            }

    $periksasekolah=sekolah::where('nama',$namasekolah)->first();
    $sekolah_id=$periksasekolah->id;

        //2. Periksa kelas ada?
    $getapi=apiprobk_deteksi::where('kunci','kelas')->where('apiprobk_id',$data->id)->first();
    $periksa=kelas::where('sekolah_id',$sekolah_id)->where('nama',$getapi->isi)->count();
    if($periksa<1){
        //inser siswa
                DB::table('kelas')->insert(
                    array(
                        'sekolah_id'     =>  $sekolah_id,
                        'nama'     =>  $getapi->isi,
                        'walikelas_id'     =>  null,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ));

    }
    $getkelas=kelas::where('sekolah_id',$sekolah_id)->where('nama',$getapi->isi)->first();

        //3. Periksa siswa ada?
    $namasiswa=apiprobk_sertifikat::where('kunci','nama')->where('apiprobk_id',$data->id)->first();
    $no_induk=apiprobk_sertifikat::where('kunci','no_induk')->where('apiprobk_id',$data->id)->first();
    $periksa=siswa::where('sekolah_id',$sekolah_id)
                ->where('nama',$namasiswa->isi)
                ->where('nomerinduk',$no_induk->isi)
                ->count();
    if($periksa<1){
        //inser siswa
                DB::table('siswa')->insert(
                    array(
                        'nomerinduk'     =>  $no_induk->isi,
                        'nama'     =>  $namasiswa->isi,
                        'kelas_id'     =>  $getkelas->id,
                        'sekolah_id'     =>  $sekolah_id,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ));

    }
// ambildata siswa
$datasiswa=siswa::where('nomerinduk',$no_induk->isi)
    ->where('nama',$namasiswa->isi)
    ->where('sekolah_id',$sekolah_id)
    ->first();

    // dd($periksa);
        //3. Periksa nilai siswa ada?
        // a. get masternilaipsikologi
        $getmasternilaipsikologi=masternilaipsikologi::get();
        foreach($getmasternilaipsikologi as $master){
            $namamaster=$master->nama;
            $isi=null;
            // b. get apiproduk_sertifikat where kunci= nama masternilaipsikologi
            $getapiprobk=apiprobk_sertifikat::where('kunci',$namamaster)->first();
            if($getapiprobk!=null){
                $isi=$getapiprobk->isi;
            }
            // dd($getapiprobk->isi);
            // c. jika belum ada maka insert
            $periksa=inputnilaipsikologi::where('siswa_id',$datasiswa->id)
            ->where('masternilaipsikologi_id',$master->id)
            ->where('sekolah_id',$sekolah_id)
            ->count();

            if($periksa<1){
                DB::table('inputnilaipsikologi')->insert(
                    array(
                        'siswa_id'     =>  $datasiswa->id,
                        'masternilaipsikologi_id'     =>  $master->id,
                        'nilai'     =>  $isi,
                        'sekolah_id'     =>  $sekolah_id,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ));
            }
        }

        //minatbakat
        $getmasterminatbakat=minatbakat::get();
        foreach($getmasterminatbakat as $master){
            $isi=null;
            // b. get apiproduk_sertifikat where kunci= nama masternilaipsikologi
            $getapiprobk=apiprobk_sertifikat::where('kunci',$namamaster)->first();
            if($getapiprobk!=null){
                $isi=$getapiprobk->isi;
            }

            // c. jika belum ada maka insert
            $periksa=minatbakatdetail::where('siswa_id',$datasiswa->id)
            ->where('minatbakat_id',$master->id)
            ->where('sekolah_id',$sekolah_id)
            ->count();

            if($periksa<1){
                DB::table('minatbakatdetail')->insert(
                    array(
                        'siswa_id'     =>  $datasiswa->id,
                        'minatbakat_id'     =>  $master->id,
                        'nilai'     =>  $isi,
                        'sekolah_id'     =>  $sekolah_id,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ));
            }

        }


//end datas
    }
        return redirect()->back()->with('status','Data berhasil Di sinkron!')->with('tipe','success')->with('icon','fas fa-edit');
    }
}
