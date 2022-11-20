<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ReportPertandingan;
use Validator;
use App\Http\Resources\ReportPertandinganResource;
   
class ReportPertandinganController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportpertandingans = Jadwal::with('hasils');
    
        //return $this->sendResponse(ReportPertandinganResource::collection($reportpertandingans), 'Report Pertandingan  retrieved successfully.');
        return $this->sendResponse($reportpertandingans, 'Report Pertandingan retrieved successfully.');
    }
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reportpertandingan = Jadwal::with('hasils')->find($id);
  
        if (is_null($reportpertandingan)) {
            return $this->sendError('Report Pertandingan not found.');
        }
   
        return $this->sendResponse($reportpertandingan, 'Report Pertandingan retrieved successfully.');
    }
    
}