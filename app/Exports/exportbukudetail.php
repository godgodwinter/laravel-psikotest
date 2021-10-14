<?php

namespace App\Exports;

use App\Http\Resources\bukudetailresource;
use App\Http\Resources\bukurakresource;
use App\Http\Resources\bukuresource;
use App\Http\Resources\kelasresource;
use App\Http\Resources\siswaresource;
use App\Http\Resources\tapelresource;
use App\Models\siswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class exportbukudetail implements FromCollection, WithHeadings, ShouldAutoSize
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
            'buku_kode',
            'buku_isbn',
            'buku_nama',
            'buku_pengarang',
            'buku_tempatterbit',
            'buku_penerbit',
            'buku_tahunterbit',
            'buku_bahasa',
            'bukukategori_nama',
            'bukukategori_ddc',
            'kondisi',
            'status',
            'created_at',
            'updated_at',
        ];
    }
    public function collection()
    {
            // return pelanggan::all();
            // $datas=DB::table('siswa')->select('id', 'nama' ,'nis', 'agama', 'tempatlahir','tgllahir','alamat','tapel_nama','kelas_nama' ,'jk','created_at', 'updated_at')->get();
            // dd($datas);
            // return  $datas;

        // $datas=siswa::latest()->get();

    $datas = DB::table('bukudetail')
    // ->join('users','users.nomerinduk','=','siswa.nis')
    // ->whereraw('tagihan.paket_harga > tagihan.total_bayar')
    ->get();
    // dd($datas);
        return bukudetailresource::collection($datas);
    }
}
