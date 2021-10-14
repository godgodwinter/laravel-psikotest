<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class bukuresource extends JsonResource
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
            'kode'=>$this->kode,
            'isbn'=>$this->isbn,
            'nama'=>$this->nama,
            'pengarang'=>$this->pengarang,
            'tempatterbit'=>$this->tempatterbit,
            'penerbit'=>$this->penerbit,
            'tahunterbit'=>$this->tahunterbit,
            'bahasa'=>$this->bahasa,
            'bukukategori_nama'=>$this->bahasa,
            'bukukategori_ddc'=>$this->bukukategori_ddc,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
