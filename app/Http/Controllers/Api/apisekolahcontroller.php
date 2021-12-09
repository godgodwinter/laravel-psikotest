<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\sekolah;
use Illuminate\Http\Request;

class apisekolahcontroller extends Controller
{
    public function index(Request $request)
    {

        $datas = sekolah::get();
        # code...
        return response()->json([
            'success' => true,
            'message' => 'Success!',
            'data' =>$datas
        ]);
    }
}
