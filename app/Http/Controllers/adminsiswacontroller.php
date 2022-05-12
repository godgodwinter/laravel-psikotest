<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\sekolah;
use App\Models\siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class adminsiswacontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->tipeuser != 'admin'  && Auth::user()->tipeuser != 'owner') {
                return redirect()->route('dashboard')->with('status', 'Halaman tidak ditemukan!')->with('tipe', 'danger');
            }

            return $next($request);
        });
    }
    public function index(sekolah $id, Request $request)
    {
        $pages = 'siswa';
        $datas = siswa::with('kelas')
            ->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->orderBy('nama', 'asc')
            ->paginate(Fungsi::paginationjml());


        return view('pages.admin.sekolah.pages.siswa_index', compact('pages', 'id', 'request', 'datas'));
    }
    public function create(sekolah $id)
    {
        $pages = 'siswa';

        $kelas = DB::table('kelas')->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->get();
        return view('pages.admin.sekolah.pages.siswa_create', compact('pages', 'id', 'kelas'));
    }

    public function store(sekolah $id, Request $request)
    {
        // dd($id,$request);
        $cek = siswa::with('users')->where('nomerinduk', $request->nomerinduk)
            ->where('sekolah_id', $id->id)
            ->orderBy('nama', 'asc')
            ->count();
        // dd($cek);
        if ($cek > 0) {
            $request->validate(
                [
                    // 'nama'=>'required|unique:siswa,nama',
                    // 'nomerinduk'=>'required|unique:siswa,nomerinduk',

                ],
                [
                    // 'nomerinduk.unique'=>'Nomer Induk sudah digunakan',
                ]
            );
        }

        $request->validate(
            [
                'nama' => 'required',
                'nomerinduk' => 'required',

            ],
            [
                'nama.nama' => 'Nama harus diisi',
            ]
        );


        //inser siswa
        DB::table('siswa')->insert(
            array(
                'nama'     =>   $request->nama,
                'nomerinduk'     =>   $request->nomerinduk,
                'sekolah_id'     =>   $id->id,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'jeniskelamin'   =>   $request->jeniskelamin,
                'tempatlahir'    =>   $request->tempatlahir,
                'tanggallahir'   =>   $request->tanggallahir,
                'usia'           =>   $request->usia,
                'warganegara'    =>   $request->warganegara,
                'agama'          =>   $request->agama,
                'anak'           =>   $request->anak,
                'kandung'        =>   $request->kandung,
                'angkat'         =>   $request->angkat,
                'tiri'           =>   $request->tiri,
                'statusanak'     =>   $request->statusanak,
                'bahasa'         =>   $request->bahasa,
                'nohp'           =>   $request->nohp,
                'tinggal'        =>   $request->tinggal,
                'jarak'          =>   $request->jarak,
                'goldar'         =>   $request->goldar,
                'kelainan'       =>   $request->kelainan,
                'tinggibadan'    =>   $request->tinggibadan,
                'beratbadan'     =>   $request->beratbadan,
                'tamatan'        =>   $request->tamatan,
                'ijazah'         =>   $request->ijazah,
                'lamabelajar'    =>   $request->lamabelajar,
                'pindahan'       =>   $request->pindahan,
                'alasan'         =>   $request->alasan,
                'namaayah'       =>   $request->namaayah,
                'tempatayah'     =>   $request->tempatayah,
                'tanggallahirayah' =>   $request->tanggallahirayah,
                'agamaayah'      =>   $request->agamaayah,
                'warganegaraayah' =>   $request->warganegaraayah,
                'pendidikanayah' =>   $request->pendidikanayah,
                'pekerjaanayah'  =>   $request->pekerjaanayah,
                'alamatayah'     =>   $request->alamatayah,
                'nomorayah'      =>   $request->nomorayah,
                'statusayah'     =>   $request->statusayah,
                'namaibu'        =>   $request->namaibu,
                'tempatibu'      =>   $request->tempatibu,
                'tanggallahiribu' =>   $request->tanggallahiribu,
                'agamaibu'       =>   $request->agamaibu,
                'warganegaraibu' =>   $request->warganegaraibu,
                'pendidikanibu'  =>   $request->pendidikanibu,
                'pekerjaanibu'   =>   $request->pekerjaanibu,
                'penghasilanibu' =>   $request->penghasilanibu,
                'alamatibu'      =>   $request->alamatibu,
                'nomoribu'       =>   $request->nomoribu,
                'statusibu'      =>   $request->statusibu,
                'namawali'       =>   $request->namawali,
                'tempatwali'     =>   $request->tempatwali,
                'tanggallahirwali' =>   $request->tanggallahirwali,
                'agamawali'      =>   $request->agamawali,
                'warganegarawali' =>   $request->warganegarawali,
                'pendidikanwali' =>   $request->pendidikanwali,
                'pekerjaanwali'  =>   $request->pekerjaanwali,
                'penghasilanwali' =>   $request->penghasilanwali,
                'alamatwali'     =>   $request->alamatwali,
                'nomorwali'      =>   $request->nomorwali,
                'statuswali'     =>   $request->statuswali,
                'hobi'           =>   $request->hobi,
                'organisasi'     =>   $request->organisasi,
                'setelahlulus'   =>   $request->setelahlulus,
                'kelas_id'   =>   $request->kelas_id
            )
        );

        return redirect()->route('sekolah.siswa', $id->id)->with('status', 'Data berhasil tambahkan!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }

    public function edit(sekolah $id, siswa $data)
    {
        $pages = 'siswa';

        $data = siswa::with('kelas')->with('sekolah')->where('id', $data->id)->first();
        // dd($data->kelas->nama);

        $kelas = DB::table('kelas')
            ->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->get();
        $datasekolah = sekolah::get();

        return view('pages.admin.sekolah.pages.siswa_edit', compact('pages', 'id', 'data', 'kelas', 'datasekolah'));
    }
    public function update(sekolah $id, siswa $data, Request $request)
    {
        if ($request->nomerinduk !== $data->nomerinduk) {

            $request->validate(
                [
                    'nama' => "required",
                    'nomerinduk' => "required|unique:siswa,nomerinduk," . $request->nomerinduk,
                ],
                [
                    'nomerinduk.unique' => 'Nomer induk sudah digunakan',
                ]
            );
        }


        $request->validate(
            [
                'nama' => 'required',
                //'nomerinduk'=>'required',
            ],
            [
                'nama.required' => 'nama harus diisi',
                //'nomerinduk.required'=>'nomerinduk harus diisi',
            ]
        );


        siswa::where('id', $data->id)
            ->update([
                'nama'     =>   $request->nama,
                'nomerinduk'     =>   $request->nomerinduk,
                'sekolah_id'     =>   $request->sekolah_id,
                'updated_at' => date("Y-m-d H:i:s"),
                'jeniskelamin'   =>   $request->jeniskelamin,
                'tempatlahir'    =>   $request->tempatlahir,
                'tanggallahir'   =>   $request->tanggallahir,
                'usia'           =>   $request->usia,
                'warganegara'    =>   $request->warganegara,
                'agama'          =>   $request->agama,
                'anak'           =>   $request->anak,
                'kandung'        =>   $request->kandung,
                'angkat'         =>   $request->angkat,
                'tiri'           =>   $request->tiri,
                'statusanak'     =>   $request->statusanak,
                'bahasa'         =>   $request->bahasa,
                'nohp'           =>   $request->nohp,
                'tinggal'        =>   $request->tinggal,
                'jarak'          =>   $request->jarak,
                'goldar'         =>   $request->goldar,
                'kelainan'       =>   $request->kelainan,
                'tinggibadan'    =>   $request->tinggibadan,
                'beratbadan'     =>   $request->beratbadan,
                'tamatan'        =>   $request->tamatan,
                'ijazah'         =>   $request->ijazah,
                'lamabelajar'    =>   $request->lamabelajar,
                'pindahan'       =>   $request->pindahan,
                'alasan'         =>   $request->alasan,
                'namaayah'       =>   $request->namaayah,
                'tempatayah'     =>   $request->tempatayah,
                'tanggallahirayah' =>   $request->tanggallahirayah,
                'agamaayah'      =>   $request->agamaayah,
                'warganegaraayah' =>   $request->warganegaraayah,
                'pendidikanayah' =>   $request->pendidikanayah,
                'pekerjaanayah'  =>   $request->pekerjaanayah,
                'alamatayah'     =>   $request->alamatayah,
                'nomorayah'      =>   $request->nomorayah,
                'statusayah'     =>   $request->statusayah,
                'namaibu'        =>   $request->namaibu,
                'tempatibu'      =>   $request->tempatibu,
                'tanggallahiribu' =>   $request->tanggallahiribu,
                'agamaibu'       =>   $request->agamaibu,
                'warganegaraibu' =>   $request->warganegaraibu,
                'pendidikanibu'  =>   $request->pendidikanibu,
                'pekerjaanibu'   =>   $request->pekerjaanibu,
                'penghasilanibu' =>   $request->penghasilanibu,
                'alamatibu'      =>   $request->alamatibu,
                'nomoribu'       =>   $request->nomoribu,
                'statusibu'      =>   $request->statusibu,
                'namawali'       =>   $request->namawali,
                'tempatwali'     =>   $request->tempatwali,
                'tanggallahirwali' =>   $request->tanggallahirwali,
                'agamawali'      =>   $request->agamawali,
                'warganegarawali' =>   $request->warganegarawali,
                'pendidikanwali' =>   $request->pendidikanwali,
                'pekerjaanwali'  =>   $request->pekerjaanwali,
                'penghasilanwali' =>   $request->penghasilanwali,
                'alamatwali'     =>   $request->alamatwali,
                'nomorwali'      =>   $request->nomorwali,
                'statuswali'     =>   $request->statuswali,
                'hobi'           =>   $request->hobi,
                'organisasi'     =>   $request->organisasi,
                'setelahlulus'   =>   $request->setelahlulus,
                'kelas_id'       =>   $request->kelas_id

            ]);
        return redirect()->route('sekolah.siswa', $id->id)->with('status', 'Data berhasil diubah!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }
    public function destroy(sekolah $id, siswa $data)
    {

        siswa::destroy($data->id);
        return redirect()->route('sekolah.siswa', $id->id)->with('status', 'Data berhasil dihapus!')->with('tipe', 'warning')->with('icon', 'fas fa-feather');
    }
    public function cari(sekolah $id, Request $request)
    {
        if ($this->checkauth('admin') === '404') {
            return redirect(URL::to('/') . '/404')->with('status', 'Halaman tidak ditemukan!')->with('tipe', 'danger')->with('icon', 'fas fa-trash');
        }
        //dd($request);
        $cari = $request->cari;
        #WAJIB
        $pages = 'siswa';
        $datas = siswa::with('kelas')
            ->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->where('nama', 'like', "%" . $cari . "%")
            ->orWhere('nomerinduk', 'like', "%" . $cari . "%")
            ->where('sekolah_id', $id->id)
            ->paginate(Fungsi::paginationjml());


        return view('pages.admin.sekolah.pages.siswa_index', compact('pages', 'id', 'request', 'datas'));
    }

    public function multidel(sekolah $id, Request $request)
    {

        $ids = $request->ids;
        siswa::whereIn('id', $ids)->delete();

        // load ulang
        #WAJIB
        $pages = 'siswa';
        $datas = siswa::with('kelas')
            ->whereNull('deleted_at')
            ->where('sekolah_id', $id->id)
            ->orderBy('nama', 'asc')
            ->paginate(Fungsi::paginationjml());


        return view('pages.admin.sekolah.pages.siswa_index', compact('pages', 'id', 'request', 'datas'));
    }
    public function generate(sekolah $id, Request $request)
    {
        $faker = Faker::create('id_ID');
        $getsiswa = siswa::where('sekolah_id', $id->id)->get();
        foreach ($getsiswa as $siswa) {
            $siswa_id = $siswa->id;
            //periksa apakah user where siswa_id sudah ada?
            if ($siswa->users_id == null) {
                $periksa = User::where('id', $siswa->users_id)->count();
                if ($periksa < 1) {
                    //insert users dan update siswa
                    // $username=$faker->unique()->username;
                    // $username = substr(strtolower(str_replace(' ', '', $siswa->nama)),0,6).$faker->numberBetween(0,999);
                    $username = Fungsi::randomuserssiswa($siswa->nama, $siswa_id);
                    $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
                    // $password=$faker->password(8, 8);
                    // if($)
                    // if($periksausername>0){

                    // }
                    // dd($username,$password);
                    $users_id = DB::table('users')->insertGetId(
                        array(
                            'name'     =>   $siswa->nama,
                            'email'     =>   null,
                            'username'     =>   $username,
                            'nomerinduk'     => null,
                            'password' => Hash::make($password),
                            'tipeuser' => 'siswa',
                            'created_at' => date("Y-m-d H:i:s"),
                            'updated_at' => date("Y-m-d H:i:s")
                        )
                    );

                    // update
                    // 1 users_id
                    // 2 passworddefault
                    siswa::where('id', $siswa->id)
                        ->update([
                            'users_id'     =>   $users_id,
                            'passworddefault'     =>   $password,
                            'updated_at' => date("Y-m-d H:i:s"),

                        ]);
                } else {
                    //update users
                    dd('update');
                }
            }
        }
        // dd('prosesgenerateakun',$getsiswa);
        return redirect()->route('sekolah.siswa', $id->id)->with('status', 'Generate Akun berhasil!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }
    public function generateakun(sekolah $id, Request $request)
    {
        $pages = 'siswa';
        $data = siswa::where('sekolah_id', $id->id)->where('users_id', NULL)
            ->get();
        $totaldata = siswa::where('sekolah_id', $id->id)->where('users_id', NULL)
            ->count();
        // dd($data);
        return view('pages.admin.sekolah.pages.siswa.generateakun', compact('pages', 'id', 'data', 'totaldata'));
    }
    public function api_getsiswa(sekolah $id, Request $request)
    {
        $data = siswa::where('sekolah_id', $id->id)->where('users_id', NULL)->get();
        return response()->json([
            'success'    => true,
            'data'    => $data,
        ], 200);
    }
    public function api_generate(sekolah $id, siswa $siswa, Request $request)
    {
        // $data = siswa::where('sekolah_id', $id->id)->get();
        $siswa_id = $siswa->id;
        //periksa apakah user where siswa_id sudah ada?
        if ($siswa->users_id == null) {
            $periksa = User::where('id', $siswa->users_id)->count();
            if ($periksa < 1) {
                //insert users dan update siswa
                // $username=$faker->unique()->username;
                // $username = substr(strtolower(str_replace(' ', '', $siswa->nama)),0,6).$faker->numberBetween(0,999);
                $username = Fungsi::randomuserssiswa($siswa->nama, $siswa_id);
                $password = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
                // $password=$faker->password(8, 8);
                // if($)
                // if($periksausername>0){

                // }
                // dd($username,$password);
                $users_id = DB::table('users')->insertGetId(
                    array(
                        'name'     =>   $siswa->nama,
                        'email'     =>   null,
                        'username'     =>   $username,
                        'nomerinduk'     => null,
                        'password' => Hash::make($password),
                        'tipeuser' => 'siswa',
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    )
                );

                // update
                // 1 users_id
                // 2 passworddefault
                siswa::where('id', $siswa->id)
                    ->update([
                        'users_id'     =>   $users_id,
                        'passworddefault'     =>   $password,
                        'updated_at' => date("Y-m-d H:i:s"),

                    ]);
            } else {
                //update users
                dd('update');
            }
        }
        return response()->json([
            'success'    => true,
            'data'    => $siswa,
        ], 200);
    }
}
