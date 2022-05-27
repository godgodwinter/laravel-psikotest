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
use App\Models\masterdeteksi;
use App\Models\masterdeteksi_pemecahanmasalah;
use App\Models\siswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class exportPenanganan implements FromCollection, WithHeadings, ShouldAutoSize
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
            'masterdeteksi_id',
            'batasbawah',
            'batasbawah',
            'keterangan',
            'deleted_at',
            'created_at',
            'uploaded_at',
            'namamaster',
        ];
    }
    public function collection()
    {
        // $datas = DB::table('penjelasan_faktorkepribadian')->whereNull('deleted_at')
        //     ->get();
        $datas = masterdeteksi_pemecahanmasalah::whereHas('masterdeteksi', function ($query) {
            $query->where('deleted_at', '=', null);
        })->get();
        foreach ($datas as $data) {
            $getMasterDeteksi = masterdeteksi::where('id', $data->masterdeteksi_id)->first();
            $data->namamaster = $getMasterDeteksi->nama;
        }
        return $datas;
    }
}
