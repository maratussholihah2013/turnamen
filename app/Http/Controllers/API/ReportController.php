<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\JadwalPertandingan;
use Validator;
use App\Http\Resources\ReportResource;
use Illuminate\Support\Facades\DB;
   
class ReportController extends BaseController
{   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];
        $reportpertandingan = JadwalPertandingan::with(['timhome','timaway'])->find($id);                                                
        if (is_null($reportpertandingan)) {
            return $this->sendError('Report Pertandingan not found.');
        }
        $timhome = $reportpertandingan->tim_home;
        $timaway = $reportpertandingan->tim_away;
        $countHomeMenang = JadwalPertandingan::where(function($query) use ($timhome) {
                                                    $query->where('tim_home', $timhome)
                                                        ->where('total_skor_home', '>', 'total_skor_away');
                                                })
                                                ->orWhere(function($query) use ($timhome) {
                                                    $query->where('tim_away', $timhome)
                                                        ->where('total_skor_away', '>', 'total_skor_home');
                                                })->count();
        $countAwayMenang = JadwalPertandingan::where(function($query) use ($timaway) {
                                                    $query->where('tim_home', $timaway)
                                                        ->where('total_skor_home', '>', 'total_skor_away');
                                                })
                                                ->orWhere(function($query) use ($timaway) {
                                                    $query->where('tim_away', $timaway)
                                                        ->where('total_skor_away', '>', 'total_skor_home');
                                                })->count();
       $topScorrer = DB::select(DB::raw('SELECT pemain_id,COUNT(pemain_id) as score
                              FROM hasil_pertandingans 
                              WHERE jadwal_id='.$id.' 
                              GROUP by pemain_id 
                              HAVING COUNT(pemain_id)= (SELECT MAX(t.c) 
                                                        from (SELECT COUNT(pemain_id) c 
                                                                FROM hasil_pertandingans 
                                                                WHERE jadwal_id='.$id.' 
                                                                GROUP BY pemain_id) t)'));
        $data['pertandingan'] = $reportpertandingan;
        $data['countHome'] = $countHomeMenang;
        $data['countAway'] = $countAwayMenang;
        $data['topScorrer'] = $topScorrer;
        
   
        return $this->sendResponse(new ReportResource($data), 'Report Pertandingan retrieved successfully.');
    }
    
}