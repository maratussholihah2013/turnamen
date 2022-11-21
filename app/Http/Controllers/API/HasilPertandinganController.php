<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\HasilPertandingan;
use Validator;
use App\Http\Resources\HasilPertandinganResource;
   
class HasilPertandinganController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hasilpertandingans = HasilPertandingan::all();
    
        return $this->sendResponse(HasilPertandinganResource::collection($hasilpertandingans), 'Hasil Pertandingan  retrieved successfully.');
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
            'pemain_id' => 'required|exists:pemains,id',
            'waktu_gol' => 'required|numeric|regex:/^[0-9]++.+$/[0-9]',
       ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $hasilpertandingan = Product::create($input);
   
        return $this->sendResponse(new HasilPertandinganResource($hasilpertandingan), 'Hasil Pertandingan created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hasilpertandingan = HasilPertandingan::find($id);
  
        if (is_null($hasilpertandingan)) {
            return $this->sendError('Hasil Pertandingan not found.');
        }
   
        return $this->sendResponse(new HasilPertandinganResource($hasilpertandingan), 'Hasil Pertandingan retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HasilPertandingan $hasilpertandingan)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [          
            'pemain_id' => 'required|exists:pemains,id',
            'waktu_gol' => 'required|numeric|regex:/^[0-9]++.+$/[0-9]',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $hasilpertandingan->update([
            'pemain_id' => $input->pemain_id,
            'waktu_gol' => $input->waktu_gol,
        ]);
        $hasilpertandingan->save();
   
        return $this->sendResponse(new HasilPertandinganResource($hasilpertandingan), 'Hasil Pertandingan updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HasilPertandingan $hasilpertandingan)
    {
        $hasilpertandingan->delete();
   
        return $this->sendResponse([], 'Hasil Pertandingan deleted successfully.');
    }
    
    //Get semua data yg sudah di soft delete
    public function trash()
    {
        $hasilpertandingans = HasilPertandingan::onlyTrashed();

        return $this->sendResponse(HasilPertandinganResource::collection($hasilpertandingans), 'Hasil Pertandingan retrieved successfully.');
    }
    
    //mengembalikan data hasilpertandingan yang telah di soft delete
    public function restore($id)
    {
        $hasilpertandingan = HasilPertandingan::onlyTrashed()->findOrFail($id);
        $hasilpertandingan->restore();
        
        return $this->sendResponse(new HasilPertandinganResource($hasilpertandingan), 'Hasil Pertandingan updated successfully.');
    }
    
    //menghapus permanen
    public function delete($id)
    {
        $hasilpertandingan = HasilPertandingan::onlyTrashed()->findOrFail($id);
        $hasilpertandingan->forceDelete();
        return $this->sendResponse([], 'Hasil Pertandingan deleted permanently successfully.');
    }
}