<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\JadwalPertandingan;
use Validator;
use App\Http\Resources\JadwalPertandinganResource;
   
class JadwalPertandinganController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwalpertandingans = JadwalPertandingan::all();
    
        return $this->sendResponse(JadwalPertandinganResource::collection($jadwalpertandingans), 'Jadwal Pertandingan  retrieved successfully.');
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
            'tanggal' => 'required|date_format:Y-m-d',
            'waktu' => 'required|date_format:H:i',
            'tim_home' => 'required|exists:tims,id',
            'tim_away' => 'required|exists:tims,id|different:tim_home',
       ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $jadwalpertandingan = Product::create($input);
   
        return $this->sendResponse(new JadwalPertandinganResource($jadwalpertandingan), 'Jadwal Pertandingan created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwalpertandingan = JadwalPertandingan::find($id);
  
        if (is_null($jadwalpertandingan)) {
            return $this->sendError('Jadwal Pertandingan not found.');
        }
   
        return $this->sendResponse(new JadwalPertandinganResource($jadwalpertandingan), 'Jadwal Pertandingan retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JadwalPertandingan $jadwalpertandingan)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [            
            'tanggal' => 'required|date_format:Y-m-d',
            'waktu' => 'required|date_format:H:i',
            'tim_home' => 'required|exists:tims,id',
            'tim_away' => 'required|exists:tims,id|different:tim_home',
            'total_skor_home' => 'required|numeric',
            'total_skor_away' => 'required|numeric',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $jadwalpertandingan->update([
            'nama' => $input->nama,
            'tinggi_badan' => $input->tinggi_badan,
            'berat_badan' => $input->berat_badan,
            'posisi' => $input->posisi,
            'nomor_punggung' => $input->nomor_punggung,
        ]);
        $jadwalpertandingan->save();
   
        return $this->sendResponse(new JadwalPertandinganResource($jadwalpertandingan), 'Jadwal Pertandingan updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(JadwalPertandingan $jadwalpertandingan)
    {
        $jadwalpertandingan->delete();
   
        return $this->sendResponse([], 'Jadwal Pertandingan deleted successfully.');
    }
    //Get semua data yg sudah di soft delete
    public function trash()
    {
        $jadwalpertandingans = JadwalPertandingan::onlyTrashed();

        return $this->sendResponse(JadwalPertandinganResource::collection($jadwalpertandingans), 'Jadwal Pertandingan retrieved successfully.');
    }
    
    //mengembalikan data jadwalpertandingan yang telah di soft delete
    public function restore($id)
    {
        $jadwalpertandingan = JadwalPertandingan::onlyTrashed()->findOrFail($id);
        $jadwalpertandingan->restore();
        
        return $this->sendResponse(new JadwalPertandinganResource($jadwalpertandingan), 'Jadwal Pertandingan updated successfully.');
    }
    
    //menghapus permanen
    public function delete($id)
    {
        $jadwalpertandingan = JadwalPertandingan::onlyTrashed()->findOrFail($id);
        $jadwalpertandingan->forceDelete();
        return $this->sendResponse([], 'Jadwal Pertandingan deleted permanently successfully.');
    }
}