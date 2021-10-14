<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class anggotaresource extends JsonResource
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
            'nama'=>$this->nama,
            'nomeridentitas'=>$this->nomeridentitas,
            'agama'=>$this->agama,
            'tempatlahir'=>$this->tempatlahir,
            'tgllahir'=>$this->tgllahir,
            'alamat'=>$this->alamat,
            'jk'=>$this->jk,
            'tipe'=>$this->tipe,
            'sekolahasal'=>$this->sekolahasal,
            'telp'=>$this->telp,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
