<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
  
class HasilsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'pemain_id' => $this->pemain_id,
            'pemain_nama' => $this->pemain->nama,
            'waktu_gol' => $this->waktu_gol,
        ];
    }
}