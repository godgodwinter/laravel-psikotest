<?php

namespace App\Http\Controllers;

use App\Exports\exportdetailsekolah;
use App\Exports\exportsekolah;
use App\Imports\importdetailsekolah;
use App\Imports\importsekolah;
use App\Imports\importusername;
use App\Models\apiprobk;
use App\Models\apiprobk_deteksi;
use App\Models\apiprobk_deteksi_list;
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
use Illuminate\Support\Facades\Validator;

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
// dd('tes');
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
	public function backuptempfe(Request $request)
	{
        $pages='sekolah';
        $datas=apiprobk::where('deteksi','!=','sudah')
        ->where('deteksi','belum')
        ->orWhere('sertifikat','belum')
        ->orderBy('created_at','desc')
        // ->skip(0)->take(10)
        ->get();
            // dd('backuptempfe',$datas);
        return view('pages.admin.sekolah.backupapiprobk',compact('datas','request','pages'));


    }
//     public function backuptempfestore(Request $request){
//         $datas=$request->data;
//         // foreach($datas as $data){
//         //     dd($data);
//         // }
//         // dd($request,json_decode($request->dataDeteksi),json_decode($request->data));
//         $hasildeteksi=json_decode($request->dataDeteksi);
//         $hasilsertifikat=json_decode($request->data);
//             //looping deteksi
//         foreach($hasildeteksi as $data){
//             foreach($data as $k => $v){
//                 // dd($v);
//                 if($k==='0'){
//                     $username=$v;
//                 }
//             }
//             // dd($hasildeteksi);
//             $getid=apiprobk::where('username',$username)->first();
//             $itemscount=apiprobk_deteksi::where('apiprobk_id',$getid->id)->count();
//             foreach($data as  $key => $value){
//                 if($key!='deteksi_list'){
//                     // dd($value);
//                         //simpan apiprobk_deteksi
//                             //insert all
//                             DB::table('apiprobk_deteksi')->insert(
//                                 array(
//                                     'apiprobk_id'     =>  $getid->id,
//                                     'kunci'     =>   $key,
//                                     'isi'     =>   $value,
//                                     'deleted_at' => null,
//                                     'created_at'=>date("Y-m-d H:i:s"),
//                                     'updated_at'=>date("Y-m-d H:i:s")
//                                 ));
//                 }else{
//                 //   dd('list');
//                     foreach($data->deteksi_list as $item){
//                         // dd($item->deteksi_nama);
//                             DB::table('apiprobk_deteksi_list')->insert(
//                                 array(
//                                     'apiprobk_id'     =>  $getid->id,
//                                     'nama'     =>   $item->deteksi_nama,
//                                     'score'     =>   $item->deteksi_score,
//                                     'keterangan'  =>   $item->deteksi_keterangan,
//                                     'rank'     =>   $item->deteksi_rank,
//                                     'deleted_at' => null,
//                                     'created_at'=>date("Y-m-d H:i:s"),
//                                     'updated_at'=>date("Y-m-d H:i:s")
//                                 ));
//                 }
//                 }
//             }
//             // dd($username);
//             //end loopingdeteksi
//             apiprobk::where('id',$getid->id)
//               ->update([
//                   'deteksi'     =>   'sudah',
//                  'updated_at'=>date("Y-m-d H:i:s")
//               ]);
//         }

//         // dd($hasilsertifikat);
//     //     //looping sertifikat
//         foreach($hasilsertifikat as $data){
//             foreach($data as $k => $v){
//                 // dd($v);
//                 if($k==='0'){
//                     $username=$v;
//                 }
//             }
//             // dd($username);
//             $getid=apiprobk::where('username',$username)->first();
//             $itemscount=apiprobk_sertifikat::where('apiprobk_id',$getid->id)->count();
//             foreach($data as  $key => $value){
//                     // dd($value);
//                         //simpan apiprobk_deteksi
//                             //insert all
//                             DB::table('apiprobk_sertifikat')->insert(
//                                 array(
//                                     'apiprobk_id'     =>  $getid->id,
//                                     'kunci'     =>   $key,
//                                     'isi'     =>   $value,
//                                     'deleted_at' => null,
//                                     'created_at'=>date("Y-m-d H:i:s"),
//                                     'updated_at'=>date("Y-m-d H:i:s")
//                                 ));

//                 }
//             // dd($username);
//             //end loopingsertifikat
//             apiprobk::where('id',$getid->id)
//               ->update([
//                   'sertifikat'     =>   'sudah',
//                  'updated_at'=>date("Y-m-d H:i:s")
//               ]);
//         }

//         // dd($hasildeteksi);
//         //simpan
//         dd('proses1');
// // return redirect()->route('detailsekolah.sinkronfromfe')->with('status','Data berhasil Diimport!')->with('tipe','success')->with('icon','fas fa-edit');

//     }

    // public function sinkronfromfe(){
    //             ini_set('max_execution_time', 3000);
    //             // 1.ambil data apiprobk
    //             $getdatas=apiprobk::get();

    //             foreach($getdatas as $data){

    //             // 2. periksa jika deteksi==belum maka sinkron

    //             // 3. periksa jika sertifikat==belum maka sinkron

    //                 // dd($data->id);

    //             $getapi=apiprobk_deteksi::where('kunci','sekolah')->where('apiprobk_id',$data->id)->first();
    //             // dd($getapi);
    //             $namasekolah=$getapi->isi;
    //             //1. Periksa sekolah ada?
    //                 $periksasekolah=sekolah::where('nama',$namasekolah)->count();
    //                 if($periksasekolah<1){
    //                     DB::table('sekolah')->insert(
    //                         array(
    //                             'nama'     =>  $namasekolah,
    //                             'status'     =>   'Aktif',
    //                             'created_at'=>date("Y-m-d H:i:s"),
    //                             'updated_at'=>date("Y-m-d H:i:s")
    //                         ));

    //                 }

    //         $periksasekolah=sekolah::where('nama',$namasekolah)->first();
    //         $sekolah_id=$periksasekolah->id;

    //             //2. Periksa kelas ada?
    //         $getapi=apiprobk_deteksi::where('kunci','kelas')->where('apiprobk_id',$data->id)->first();
    //         $periksa=kelas::where('sekolah_id',$sekolah_id)->where('nama',$getapi->isi)->count();
    //         if($periksa<1){
    //             //inser siswa
    //                     DB::table('kelas')->insert(
    //                         array(
    //                             'sekolah_id'     =>  $sekolah_id,
    //                             'nama'     =>  $getapi->isi,
    //                             'walikelas_id'     =>  null,
    //                             'created_at'=>date("Y-m-d H:i:s"),
    //                             'updated_at'=>date("Y-m-d H:i:s")
    //                         ));

    //         }
    //         $getkelas=kelas::where('sekolah_id',$sekolah_id)->where('nama',$getapi->isi)->first();

    //             //3. Periksa siswa ada?
    //         $namasiswa=apiprobk_sertifikat::where('kunci','nama')->where('apiprobk_id',$data->id)->first();
    //         $no_induk=apiprobk_sertifikat::where('kunci','no_induk')->where('apiprobk_id',$data->id)->first();
    //         $periksa=siswa::where('sekolah_id',$sekolah_id)
    //                     ->where('nama',$namasiswa->isi)
    //                     ->where('nomerinduk',$no_induk->isi)
    //                     ->count();
    //         if($periksa<1){
    //             //inser siswa
    //                     DB::table('siswa')->insert(
    //                         array(
    //                             'nomerinduk'     =>  $no_induk->isi,
    //                             'nama'     =>  $namasiswa->isi,
    //                             'kelas_id'     =>  $getkelas->id,
    //                             'sekolah_id'     =>  $sekolah_id,
    //                             'created_at'=>date("Y-m-d H:i:s"),
    //                             'updated_at'=>date("Y-m-d H:i:s")
    //                         ));

    //         }
    //     // ambildata siswa
    //     $datasiswa=siswa::where('nomerinduk',$no_induk->isi)
    //         ->where('nama',$namasiswa->isi)
    //         ->where('sekolah_id',$sekolah_id)
    //         ->first();

    //         // dd($periksa);
    //             //3. Periksa nilai siswa ada?
    //             // a. get masternilaipsikologi
    //             $getmasternilaipsikologi=masternilaipsikologi::get();
    //             foreach($getmasternilaipsikologi as $master){
    //                 $namamaster=$master->nama;
    //                 $isi=null;
    //                 // b. get apiproduk_sertifikat where kunci= nama masternilaipsikologi
    //                 $getapiprobk=apiprobk_sertifikat::where('kunci',$namamaster)->where('apiprobk_id',$data->id)->first();
    //                 if($getapiprobk!=null){
    //                     $isi=$getapiprobk->isi;
    //                 }
    //                 // dd($getapiprobk->isi);
    //                 // c. jika belum ada maka insert
    //                 $periksa=inputnilaipsikologi::where('siswa_id',$datasiswa->id)
    //                 ->where('masternilaipsikologi_id',$master->id)
    //                 ->where('sekolah_id',$sekolah_id)
    //                 ->count();
    //                 // dd($datasiswa,$isi);
    //                 if($periksa<1){
    //                     DB::table('inputnilaipsikologi')->insert(
    //                         array(
    //                             'siswa_id'     =>  $datasiswa->id,
    //                             'masternilaipsikologi_id'     =>  $master->id,
    //                             'nilai'     =>  $isi,
    //                             'sekolah_id'     =>  $sekolah_id,
    //                             'created_at'=>date("Y-m-d H:i:s"),
    //                             'updated_at'=>date("Y-m-d H:i:s")
    //                         ));
    //                 }
    //             }

    //             //minatbakat
    //             $getmasterminatbakat=minatbakat::get();
    //             foreach($getmasterminatbakat as $master){
    //                 $isi=null;
    //                 // b. get apiproduk_sertifikat where kunci= nama masternilaipsikologi
    //                 $getapiprobk=apiprobk_sertifikat::where('kunci',$master->nama)->where('apiprobk_id',$data->id)->first();
    //                 if($getapiprobk!=null){
    //                     $isi=$getapiprobk->isi;
    //                 }

    //                 // c. jika belum ada maka insert
    //                 $periksa=minatbakatdetail::where('siswa_id',$datasiswa->id)
    //                 ->where('minatbakat_id',$master->id)
    //                 ->where('sekolah_id',$sekolah_id)
    //                 ->count();
    //                 // dd($datasiswa,$isi,$master->nama);
    //                 if($periksa<1){
    //                     DB::table('minatbakatdetail')->insert(
    //                         array(
    //                             'siswa_id'     =>  $datasiswa->id,
    //                             'minatbakat_id'     =>  $master->id,
    //                             'nilai'     =>  $isi,
    //                             'sekolah_id'     =>  $sekolah_id,
    //                             'created_at'=>date("Y-m-d H:i:s"),
    //                             'updated_at'=>date("Y-m-d H:i:s")
    //                         ));
    //                 }

    //             }


    //     //end datas
    //         }
    //             return redirect()->back()->with('status','Data berhasil Di sinkron!')->with('tipe','success')->with('icon','fas fa-edit');
    //         }

    public function apibackupdatafromfe(Request $request)
    {
        $msg="Gagal di update!";
                foreach($request->data as  $key => $value){
                    $key = $key;
                    $value = $value;
                    if($key=='apiprobk_id'){
                        $apiprobk_id=$value;
                    }
                }
                $periksa=apiprobk::where('sertifikat','sudah')->where('id',$apiprobk_id)->count();
                // dd($periksa);
                if($periksa<1){
                foreach($request->data as  $key => $value){
                    // dd('key',$key,$value,$apiprobk_id);
                    $key = $key;
                    $value = $value;
                        DB::table('apiprobk_sertifikat')->insert(
                            array(
                                'apiprobk_id'     =>  $apiprobk_id,
                                'kunci'     =>   $key,
                                'isi'     =>   $value,
                                'deleted_at' => null,
                                'created_at'=>date("Y-m-d H:i:s"),
                                'updated_at'=>date("Y-m-d H:i:s")
                            ));
                            $msg="Sertifikat Berhasil di update!";


                }
                // dd('success');
            }else{
                    $msg='Sertifikat Sudah pernah Diupdate!';
                    return response()->json([
                        'success' => false,
                        'message' => $msg,
                        // 'data' => $request->data,
                        'key' => $key,
                        'value' => $value,
                        // 'key' => $request->key,
                    ], 200);

                }

                apiprobk::where('id',$apiprobk_id)
                ->update([
                    'sertifikat'     =>   'sudah',
                    'sertifikat_tgl'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s")
                ]);

                return response()->json([
                    'success' => true,
                    'message' => $msg,
                    // 'data' => $request->data,
                    // 'key' => $key,
                    // 'value' => $value,
                    // 'key' => $request->key,
                ], 200);


    }

    public function apibackupdatafromfedeteksi(Request $request)
    {
                foreach($request->data as  $key => $value){
                    $key = $key;
                    $value = $value;
                    if($key=='apiprobk_id'){
                        $apiprobk_id=$value;
                    }
                }
                $periksa=apiprobk::where('deteksi','sudah')->where('id',$apiprobk_id)->count();
                if($periksa<1){
                foreach($request->data as  $key => $value){
                    $key = $key;
                    $value = $value;
                        if($key!='deteksi_list'){
                            DB::table('apiprobk_deteksi')->insert(
                                array(
                                    'apiprobk_id'     =>  $apiprobk_id,
                                    'kunci'     =>   $key,
                                    'isi'     =>   $value,
                                    'deleted_at' => null,
                                    'created_at'=>date("Y-m-d H:i:s"),
                                    'updated_at'=>date("Y-m-d H:i:s")
                                ));
                        }else{

                            foreach($value as $item){
                                // dd($v['deteksi_nama']);
                                    DB::table('apiprobk_deteksi_list')->insert(
                                        array(
                                            'apiprobk_id'     =>  $apiprobk_id,
                                            'nama'     =>   $item['deteksi_nama'],
                                            'score'     =>   $item['deteksi_score'],
                                            'keterangan'  =>   $item['deteksi_keterangan'],
                                            'rank'     =>   $item['deteksi_rank'],
                                            'deleted_at' => null,
                                            'created_at'=>date("Y-m-d H:i:s"),
                                            'updated_at'=>date("Y-m-d H:i:s")
                                        ));
                        }
                        }
                        $msg='Deteksi Berhasil Diupdate!';

                        apiprobk::where('id',$apiprobk_id)
                        ->update([
                            'deteksi'     =>   'sudah',
                        'deteksi_tgl'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                        ]);

                }
            }else{
                $msg='Deteksi sudah pernah di update!';
                return response()->json([
                    'success' => false,
                    'message' => $msg,
                    // 'data' => $request->data,
                    'key' => $key,
                    'value' => $value,
                    // 'key' => $request->key,
                ], 200);
            }

                return response()->json([
                    'success' => true,
                    'message' => $msg,
                    // 'data' => $request->data,
                    'key' => $key,
                    'value' => $value,
                    // 'key' => $request->key,
                ], 200);
    }

    public function sinkronfe(Request $request)
    {
        $pages='sekolah';
        $datas=apiprobk::where('sinkron',NULL)
        ->where('sertifikat','sudah')
        ->where('deteksi','sudah')
        ->orderBy('created_at','desc')->get();
        $cekseedermastering=masternilaipsikologi::count();
        // dd($datas,'sinkronfe');
        return view('pages.admin.sekolah.sinkrondata',compact('datas','request','pages','cekseedermastering'));
    }
    public function sinkronfestore(Request $request)
    {
        // dd('testsinkron');
        $msg='Gagal2';
        $req=$request->data;
        foreach($req as $r){
            // return response()->json([
            //     'success' => false,
            //     'message' => $msg,
            //     'r' => $r['id'],
            //     // 'data' => $datas,
            // ], 200);
            // $datas=$r['id'];
            // 1.sekolah
            $getapi=apiprobk_deteksi::where('kunci','sekolah')->where('apiprobk_id',$r['id'])->first();
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
    $getapi=apiprobk_deteksi::where('kunci','kelas')->where('apiprobk_id',$r['id'])->first();
    $getapiprobk=apiprobk::where('id',$r['id'])->first();
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
    $namasiswa=apiprobk_sertifikat::where('kunci','nama')->where('apiprobk_id',$r['id'])->first();
    $no_induk=apiprobk_sertifikat::where('kunci','no_induk')->where('apiprobk_id',$r['id'])->first();
    $jeniskelamin="Laki-laki";
    $getjk=apiprobk_deteksi::where('kunci','jenis_kelamin')->where('apiprobk_id',$r['id'])->first();
    if($getjk->isi!="L"){
        $jeniskelamin="Perempuan";
    }
    $getusia=apiprobk_deteksi::where('kunci','umur')->where('apiprobk_id',$r['id'])->first();
    // dd($namasiswa,$no_induk);
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
                        'jeniskelamin'     =>  $jeniskelamin,
                        'usia'     =>  $getusia->isi,
                        'apiprobk_id'     =>  $r['id'],
                        'apiprobk_username'     =>  $getapiprobk->username,
                        'created_at'=>date("Y-m-d H:i:s"),
                        'updated_at'=>date("Y-m-d H:i:s")
                    ));

    }


//     // ambildata siswa
// $datasiswa=siswa::where('nomerinduk',$no_induk->isi)
//     ->where('nama',$namasiswa->isi)
//     ->where('sekolah_id',$sekolah_id)
//     ->first();

    // // dd($periksa);
    //     //3. Periksa nilai siswa ada?
    //     // a. get masternilaipsikologi
    //     $getmasternilaipsikologi=masternilaipsikologi::get();
    //     foreach($getmasternilaipsikologi as $master){
    //         $namamaster=$master->nama;
    //         $isi=null;
    //         // b. get apiproduk_sertifikat where kunci= nama masternilaipsikologi
    //         $getapiprobk=apiprobk_sertifikat::where('kunci',$namamaster)->where('apiprobk_id',$r['id'])->first();
    //         if($getapiprobk!=null){
    //             $isi=$getapiprobk->isi;
    //         }
    //         // dd($getapiprobk->isi);
    //         // c. jika belum ada maka insert
    //         $periksa=inputnilaipsikologi::where('siswa_id',$datasiswa->id)
    //         ->where('masternilaipsikologi_id',$master->id)
    //         ->where('sekolah_id',$sekolah_id)
    //         ->count();
    //         // dd($datasiswa,$isi);
    //         if($periksa<1){
    //             DB::table('inputnilaipsikologi')->insert(
    //                 array(
    //                     'siswa_id'     =>  $datasiswa->id,
    //                     'masternilaipsikologi_id'     =>  $master->id,
    //                     'nilai'     =>  $isi,
    //                     'sekolah_id'     =>  $sekolah_id,
    //                     'created_at'=>date("Y-m-d H:i:s"),
    //                     'updated_at'=>date("Y-m-d H:i:s")
    //                 ));
    //         }
    //     }

        // //minatbakat
        // $getmasterminatbakat=minatbakat::get();
        // foreach($getmasterminatbakat as $master){
        //     $isi=null;
        //     // b. get apiproduk_sertifikat where kunci= nama masternilaipsikologi
        //     $getapiprobk=apiprobk_sertifikat::where('kunci',$master->nama)->where('apiprobk_id',$r['id'])->first();
        //     if($getapiprobk!=null){
        //         $isi=$getapiprobk->isi;
        //     }

        //     // c. jika belum ada maka insert
        //     $periksa=minatbakatdetail::where('siswa_id',$datasiswa->id)
        //     ->where('minatbakat_id',$master->id)
        //     ->where('sekolah_id',$sekolah_id)
        //     ->count();
        //     // dd($datasiswa,$isi,$master->nama);
        //     if($periksa<1){
        //         DB::table('minatbakatdetail')->insert(
        //             array(
        //                 'siswa_id'     =>  $datasiswa->id,
        //                 'minatbakat_id'     =>  $master->id,
        //                 'nilai'     =>  $isi,
        //                 'sekolah_id'     =>  $sekolah_id,
        //                 'created_at'=>date("Y-m-d H:i:s"),
        //                 'updated_at'=>date("Y-m-d H:i:s")
        //             ));
        //     }

        // }


        apiprobk::where('id',$r['id'])
        ->update([
            'sinkron'     =>   'sudah',
            'sinkron_tgl'=>date("Y-m-d H:i:s"),
        'updated_at'=>date("Y-m-d H:i:s")
        ]);

                        $msg='Sukses, berhasil di sinkron!';
                        $datas=$r['id'];
        }
        //SELECT master nilai

//         // dd($getapi





        return response()->json([
            'success' => true,
            'message' => $msg,
            'data' => $datas,
        ], 200);
    }
public function resetalldata(Request $request)
    {

        apiprobk::truncate();
        apiprobk_deteksi::truncate();
        apiprobk_deteksi_list::truncate();
        apiprobk_sertifikat::truncate();
        sekolah::truncate();
        kelas::truncate();
        siswa::truncate();
        inputnilaipsikologi::truncate();
        minatbakatdetail::truncate();
        minatbakat::truncate();
        masternilaipsikologi::truncate();
        return redirect()->back()->with('status','Reset berhasil dilakukan!')->with('tipe','success')->with('icon','fas fa-edit');
    }
}
