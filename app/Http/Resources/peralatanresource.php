<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class peralatanresource extends JsonResource
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
            'kategori_nama'=>$this->kategori_nama,
            'tgl_masuk'=>$this->tgl_masuk,
            'kondisi'=>$this->kondisi,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
