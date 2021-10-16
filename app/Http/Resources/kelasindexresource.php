<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class kelasindexresource extends JsonResource
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
            'walikelas_id'=>$this->walikelas_id,
            'walikelas_nama'=>$this->walikelas_nama,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at,
        ];
    }
}
