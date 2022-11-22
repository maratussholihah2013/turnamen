<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Tim;
use Validator;
use App\Http\Resources\TimResource;
   
class TimController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tims = Tim::all();
    
        return $this->sendResponse(TimResource::collection($tims), 'Tim retrieved successfully.');
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
            'nama' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tahun_berdiri' => 'required|digits:4|integer|min:1900|max:'.\Carbon\Carbon::now()->year,
            'alamat' => 'required',
            'kota' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $logoName = $input['nama'].'_'.time().'.'.$input['logo']->extension();
        $input['logo']->move(public_path('storage'), $logoName);

        $tim = Tim::create([
            'nama' => $input['nama'],
            'logo' => $logoName,
            'tahun_berdiri' => $input['tahun_berdiri'],
            'alamat' => $input['alamat'],
            'kota' => $input['kota'],
        ]);
   
        return $this->sendResponse(new TimResource($tim), 'Tim created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tim = Tim::find($id);
  
        if (is_null($tim)) {
            return $this->sendError('Tim not found.');
        }
   
        return $this->sendResponse(new TimResource($tim), 'Tim retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tim $tim)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tahun_berdiri' => 'required|digits:4|integer|min:1900|max:'.\Carbon\Carbon::now()->year,
            'alamat' => 'required',
            'kota' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $logoName = $input['nama'].'_'.time().'.'.$input['logo']->extension();
        $input['logo']->move(public_path('storage'), $logoName);

        $tim->update([
            'nama' => $input['nama'],
            'logo' => $logoName,
            'tahun_berdiri' => $input['tahun_berdiri'],
            'alamat' => $input['alamat'],
            'kota' => $input['kota'],
        ]);
        $tim->save();
   
        return $this->sendResponse(new TimResource($tim), 'Tim updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tim $tim)
    {
        $tim->delete();
   
        return $this->sendResponse([], 'Tim deleted successfully.');
    }

    //Get semua data yg sudah di soft delete
    public function trash()
    {
        $tims = Tim::onlyTrashed()->get();
        return $this->sendResponse(TimResource::collection($tims), 'Tim retrieved successfully.');
    }
    
    //mengembalikan data tim yang telah di soft delete
    public function restore($id)
    {
        $tim = Tim::onlyTrashed()->findOrFail($id);
        $tim->restore();
        
        return $this->sendResponse(new TimResource($tim), 'Tim updated successfully.');
    }
    
    //menghapus permanen
    public function delete($id)
    {
        $tim = Tim::onlyTrashed()->findOrFail($id);
        
        if($tim->logo){
            \Storage::delete('public/storage/'.$tim->logo);
        }
        
        $tim->forceDelete();
        return $this->sendResponse([], 'Tim deleted permanently successfully.');
    }
}