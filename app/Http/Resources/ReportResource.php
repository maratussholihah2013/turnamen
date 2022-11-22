<?php
  
namespace App\Http\Resources;
   
use Illuminate\Http\Resources\Json\JsonResource;
  
class ReportResource extends JsonResource
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
            'id' => $this['pertandingan']->id,
            'tanggal' => $this['pertandingan']->tanggal,
            'waktu' => $this['pertandingan']->waktu,
            'tim_home' => $this['pertandingan']->timhome->nama,
            'tim_away' => $this['pertandingan']->timaway->nama,
            'skor_akhir' => $this['pertandingan']->skor_akhir,
            'status' => $this['pertandingan']->status,
            'akumulasi_menang_home' => $this['countHome'],
            'akumulasi_menang_away' => $this['countAway'],
            'top_scorrers' => TopscorrerResource::collection($this['topScorrer']),
        ];
    }
}

class TopscorrerResource extends JsonResource
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
            'pemain_id' => $this->pemain_id,
            'score' => $this->score,
        ];
    }
}