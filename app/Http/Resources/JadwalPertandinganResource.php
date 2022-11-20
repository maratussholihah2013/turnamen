<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
  
class JadwalPertandinganResource extends JsonResource
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
            'tanggal' => $this->tanggal,
            'waktu' => $this->waktu,
            'tim_home' => $this->tim_home,
            'tim_away' => $this->tim_away,
        ];
    }
}