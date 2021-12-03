<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\yayasan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class apilogincontroller extends Controller
{
    public function login(Request $request) {
        // $validate = Validator::make($request->all(), [
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::where('email', $request->email)
        ->where('tipeuser','yayasan')
        ->first();

            // $tokenResult = $user->createToken('token-auth')->plainTextToken;

        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => true,
                'message' => 'Login Success!',
                'data'    => $user,
                'token'   => $user->createToken('token-auth')->plainTextToken
            ]);
        }

        $user = User::where('username', $request->email)
        ->where('tipeuser','yayasan')
        ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => true,
                'message' => 'Login Success!',
                'data'    => $user,
                'token'   => $user->createToken('token-auth')->plainTextToken
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Login Failed!',
            'data'    => [
                'email' => $request->email,
                'password' => null,
            ],
        ]);


        // if ($validate->fails()) {
        //     $respon = [
        //         'status' => 'error',
        //         'msg' => 'Validator error',
        //         'errors' => $validate->errors(),
        //         'content' => null,
        //     ];
        //     return response()->json($respon, 200);
        // } else {
        //     //periksa email dan password
        //     $credentials = request(['email', 'password']);
        //     $credentials = Arr::add($credentials, 'tipeuser', 'admin');

        //     //periksa username dan password
        //     $periksa = request(['username', 'password']);
        //     $periksa = Arr::add($periksa, 'tipeuser', 'admin');
        //     if (!Auth::attempt($credentials) || !Auth::attempt($periksa) ) {

        //             return response()->json([
        //                 'success' => false,
        //                 'message' => 'Login Failed!',
        //             ]);
        //     }

        //     $user = User::where('username', $request->email)
        //     ->orwhere('email', $request->email)
        //     ->first();

        //     if (! Hash::check($request->password, $user->password, [])) {
        //         throw new \Exception('Error in Login');
        //     }

        //     $tokenResult = $user->createToken('token-auth')->plainTextToken;
        //     $respon = [

        //         'success' => true,
        //         'message' => 'Login Success!',
        //         'data'    => $user,
        //         'token'   => $tokenResult

        //         // 'status' => 'success',
        //         // 'msg' => 'Login successfully',
        //         // 'errors' => null,
        //         // 'content' => [
        //         //     'status_code' => 200,
        //         //     'access_token' => $tokenResult,
        //         //     'token_type' => 'Bearer',
        //         // ]
        //     ];
        //     return response()->json($respon, 200);



        // }
    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout Success!',
        ]);
    }

    public function logoutall(Request $request) {
        $user = $request->user();
        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout Semua akun Success!',
        ]);
    }

    public function validasitoken(Request $request)
    {
        $user = $request->user();
        // $user = DB::table('personal_access_tokens')::where('email', $request->email)
        # code...
        return response()->json([
            'success' => true,
            'message' => 'Success!',
            // 'data' =>$user
        ]);
    }
}
