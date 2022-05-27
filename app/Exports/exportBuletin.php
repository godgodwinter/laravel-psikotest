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
use App\Models\siswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class exportBuletin implements FromCollection, WithHeadings, ShouldAutoSize
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
            'nama',
            'tipe',
            'link',
            'file',
            'deleted_at',
            'created_at',
            'uploaded_at',
        ];
    }
    public function collection()
    {
        $datas = DB::table('informasipsikologi')->whereNull('deleted_at')
            ->get();

        return $datas;
    }
}
