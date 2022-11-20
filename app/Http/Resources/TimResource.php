<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
  
class TimResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'logo' => $this->logo,
            'tahun' => $this->tahun,
            'alamat' => $this->alamat,
            'kota' => $this->kota,
        ];
    }
}