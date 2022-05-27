<?php

namespace App\Exports;

use App\Http\Resources\bukudetailresource;
use App\Http\Resources\bukurakresource;
use App\Http\Resources\bukuresource;
use App\Http\Resources\kelasresource;
use App\Http\Resources\peralatanresource;
use App\Http\Resources\sekolahresource;
use App\Http\Resources\siswaresource;
use App\Http\Resources\tapelresource;
use App\Http\Resources\usersresource;
use App\Models\katabijak;
use App\Models\katabijakdetail;
use App\Models\masterdeteksi;
use App\Models\masterdeteksi_pemecahanmasalah;
use App\Models\siswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class exportKatabijak implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */

    // public function styles(Worksheet $sheet)
    // {
    //     return [
    //         // Style the first row as bold text.
    //         1    => ['font' => ['bold' => true]],


    //     ];
    // }

    public function headings(): array
    {
        return [
            'id',
            'penjelasan',
            'deleted_at',
            'created_at',
            'uploaded_at',
            'katabijak_id',
            'judul',
            'status',
        ];
    }
    public function collection()
    {
        // $datas = DB::table('penjelasan_faktorkepribadian')->whereNull('deleted_at')
        //     ->get();
        $datas = katabijakdetail::whereHas('katabijak', function ($query) {
            $query->where('deleted_at', '=', null);
        })->get();
        foreach ($datas as $data) {
            $getKatabijak = katabijak::where('id', $data->katabijak_id)->first();
            // dd($getKatabijak);
            $data->judul = $getKatabijak->judul;
            $data->status = $getKatabijak->status;
        }
        return $datas;
    }
}
