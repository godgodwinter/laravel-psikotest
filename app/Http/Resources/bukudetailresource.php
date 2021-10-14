<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class bukudetailresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'buku_kode'=>$this->buku_kode,
            'buku_isbn'=>$this->buku_isbn,
            'buku_nama'=>$this->buku_nama,
            'buku_pengarang'=>$this->buku_pengarang,
            'buku_tempatterbit'=>$this->buku_tempatterbit,
            'buku_penerbit'=>$this->buku_penerbit,
            'buku_tahunterbit'=>$this->buku_tahunterbit,
            'buku_bahasa'=>$this->buku_bahasa,
            'bukukategori_nama'=>$this->bukukategori_nama,
            'bukukategori_ddc'=>$this->bukukategori_ddc,
            'kondisi'=>$this->kondisi,
            'status'=>$this->status,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
