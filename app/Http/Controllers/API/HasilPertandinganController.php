<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\HasilPertandingan;
use App\Models\JadwalPertandingan;
use Validator;
use App\Http\Resources\HasilPertandinganResource;
use App\Http\Resources\HasilsResource;
   
class HasilPertandinganController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $hasilpertandingans = JadwalPertandingan::with(['timhome','timaway','hasils.pemain'])->find($id);
    
        return $this->sendResponse(new HasilPertandinganResource($hasilpertandingans), 'Hasil Pertandingan  retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'jadwal_id' => 'required|exists:jadwal_pertandingans,id',
            'pemain_id' => 'required|exists:pemains,id',
            'waktu_gol' => 'required|numeric|unique:hasil_pertandingans,waktu_gol,NULL,id,jadwal_id,'.$input['jadwal_id'],
       ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $create = HasilPertandingan::create($input);
        $hasilpertandingan = HasilPertandingan::with('pemain')->find($create->id);
   
        return $this->sendResponse(new HasilsResource($hasilpertandingan), 'Hasil Pertandingan created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idjadwal, $idhasil)
    {
        $hasilpertandingan = HasilPertandingan::with('pemain')->find($idhasil);
  
        if (is_null($hasilpertandingan)) {
            return $this->sendError('Hasil Pertandingan not found.');
        }
   
        return $this->sendResponse(new HasilsResource($hasilpertandingan), 'Hasil Pertandingan retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [      
            'jadwal_id' => 'required|exists:jadwal_pertandingans,id',
            'pemain_id' => 'required|exists:pemains,id',
            'waktu_gol' => 'required|numeric|unique:hasil_pertandingans,waktu_gol,NULL,id,jadwal_id,'.$input['jadwal_id'],
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $hasilpertandingan = HasilPertandingan::find($id);
        $hasilpertandingan->update($input);
        $hasilpertandingan->save();
   
        return $this->sendResponse(new HasilsResource($hasilpertandingan), 'Hasil Pertandingan updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hasilpertandingan = HasilPertandingan::find($id);
        $hasilpertandingan->delete();
   
        return $this->sendResponse([], 'Hasil Pertandingan deleted successfully.');
    }
    
    //Get semua data yg sudah di soft delete
    public function trash()
    {
        $hasilpertandingans = HasilPertandingan::onlyTrashed()->get();

        return $this->sendResponse(HasilsResource::collection($hasilpertandingans), 'Hasil Pertandingan retrieved successfully.');
    }
    
    //mengembalikan data hasilpertandingan yang telah di soft delete
    public function restore($id)
    {
        $hasilpertandingan = HasilPertandingan::onlyTrashed()->findOrFail($id);
        $hasilpertandingan->restore();
        
        return $this->sendResponse(new HasilsResource($hasilpertandingan), 'Hasil Pertandingan updated successfully.');
    }
    
    //menghapus permanen
    public function delete($id)
    {
        $hasilpertandingan = HasilPertandingan::onlyTrashed()->findOrFail($id);
        $hasilpertandingan->forceDelete();
        return $this->sendResponse([], 'Hasil Pertandingan deleted permanently successfully.');
    }
}