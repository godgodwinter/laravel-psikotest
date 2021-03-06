<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class adminuserscontroller extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->tipeuser != 'admin') {
                return redirect()->route('dashboard')->with('status', 'Halaman tidak ditemukan!')->with('tipe', 'danger');
            }

            return $next($request);
        });
    }
    public function index(Request $request)
    {
        if ($this->checkauth('admin') === '404') {
            return redirect(URL::to('/') . '/404')->with('status', 'Halaman tidak ditemukan!')->with('tipe', 'danger')->with('icon', 'fas fa-trash');
        }

        #WAJIB
        $pages = 'users';
        $datas = DB::table('users')
            ->where('tipeuser', 'admin')
            ->orWhere('tipeuser', 'owner')
            ->paginate(Fungsi::paginationjml());

        return view('pages.admin.users.index', compact('datas', 'request', 'pages'));
    }
    public function cari(Request $request)
    {
        if ($this->checkauth('admin') === '404') {
            return redirect(URL::to('/') . '/404')->with('status', 'Halaman tidak ditemukan!')->with('tipe', 'danger')->with('icon', 'fas fa-trash');
        }

        $cari = $request->cari;
        #WAJIB
        $pages = 'users';
        $datas = DB::table('users')
            ->where('tipeuser', '=', 'admin')
            ->where('name', 'like', "%" . $cari . "%")
            ->orWhere('email', 'like', "%" . $cari . "%")
            ->where('tipeuser', '=', 'admin')
            ->orWhere('username', 'like', "%" . $cari . "% ")
            ->orWhere('tipeuser', 'owner')
            ->where('name', 'like', "%" . $cari . "%")
            ->orWhere('tipeuser', 'owner')
            ->orWhere('username', 'like', "%" . $cari . "% ")
            ->orWhere('tipeuser', 'owner')
            ->orWhere('email', 'like', "%" . $cari . "%")
            ->where('tipeuser', '=', 'admin')
            ->paginate(Fungsi::paginationjml());

        return view('pages.admin.users.index', compact('datas', 'request', 'pages'));
    }
    public function create()
    {
        $pages = 'users';

        return view('pages.admin.users.create', compact('pages'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $cek = DB::table('users')
            // ->whereNull('deleted_at')
            ->where('username', $request->username)
            ->orWhere('email', $request->email)
            ->count();
        // dd($cek);
        if ($cek > 0) {
            $request->validate(
                [
                    'username' => 'required|unique:users,username',
                    'email' => 'required|unique:users,email',
                    'password' => 'min:3|required_with:password2|same:password2',
                    'password2' => 'min:3',

                ],
                [
                    'username.unique' => 'username sudah digunakan',
                ]
            );
        }

        $request->validate(
            [
                'name' => 'required',
                'username' => 'required',
                'password' => 'min:3|required_with:password2|same:password2',
                'password2' => 'min:3',

            ],
            [
                'nama.nama' => 'Nama harus diisi',
            ]
        );

        DB::table('users')->insert(
            array(
                'name'     =>   $request->name,
                'email'     =>   $request->email,
                'username'     =>   $request->username,
                'nomerinduk'     => date('YmdHis'),
                'password' => Hash::make($request->password),
                'tipeuser' => $request->tipeuser,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            )
        );

        $datausers = DB::table('users')->where('username', $request->username)->first();


        return redirect()->route('users')->with('status', 'Data berhasil tambahkan!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }

    public function edit(User $id)
    {
        $pages = 'users';

        return view('pages.admin.users.edit', compact('pages', 'id'));
    }
    public function update(User $id, Request $request)
    {

        if ($request->username !== $id->username) {

            $request->validate(
                [
                    'name' => "required",
                ],
                []
            );
        }

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'username' => 'required',
            ],
            [
                'name.required' => 'name harus diisi',
            ]
        );


        if ($request->password != null or $request->password != '') {

            $request->validate(
                [
                    'password' => 'min:3|required_with:password2|same:password2',
                    'password2' => 'min:3',
                ],
                [
                    'nama.required' => 'nama harus diisi',
                ]
            );
            User::where('id', $id->id)
                ->update([
                    'name'     =>   $request->name,
                    'username'     =>   $request->username,
                    'email'     =>   $request->email,
                    'password' => Hash::make($request->password),
                    'tipeuser' => $request->tipeuser,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
        } else {
            User::where('id', $id->id)
                ->update([
                    'name'     =>   $request->name,
                    'username'     =>   $request->username,
                    'email'     =>   $request->email,
                    'tipeuser' => $request->tipeuser,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
        }


        return redirect()->route('users')->with('status', 'Data berhasil diubah!')->with('tipe', 'success')->with('icon', 'fas fa-feather');
    }
    public function destroy(User $id)
    {

        User::destroy($id->id);
        return redirect()->route('users')->with('status', 'Data berhasil dihapus!')->with('tipe', 'warning')->with('icon', 'fas fa-feather');
    }

    public function multidel(Request $request)
    {

        $ids = $request->ids;
        User::whereIn('id', $ids)->delete();

        // load ulang
        #WAJIB
        $pages = 'users';
        $datas = DB::table('users')->where('tipeuser', 'admin')
            ->paginate(Fungsi::paginationjml());

        return view('pages.admin.users.index', compact('datas', 'request', 'pages'));
    }
}
