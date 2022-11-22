<?php
  
namespace App\Http\Resources;
use App\Http\Resources\HasilsResource;
   
use Illuminate\Http\Resources\Json\JsonResource;
  
class HasilPertandinganResource extends JsonResource
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
            'tanggal' => $this->tanggal,          
            'waktu' => $this->waktu,  
            'tim_home' => $this->timhome->nama,  
            'tim_away' => $this->timaway->nama,  
            'skor_akhir' => $this->skor_akhir,
            'hasils'=> HasilsResource::collection($this->hasils),

        ];
    }
}