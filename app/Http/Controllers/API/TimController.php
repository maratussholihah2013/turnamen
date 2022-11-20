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
    
        return $this->sendResponse(TimResource::collection($tims), 'Products retrieved successfully.');
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
            'logo' => 'required',
            'tahun_berdiri' => 'required|digits:4|integer|min:1900|max:'.\Carbon\Carbon::now()->year,
            'alamat' => 'required',
            'kota' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $tim = Tim::create($input);
   
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
            'logo' => 'required',
            'tahun_berdiri' => 'required|digits:4|integer|min:1900|max:'.\Carbon\Carbon::now()->year,
            'alamat' => 'required',
            'kota' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $tim->update([
            'nama' => $input->nama,
            'logo' => $input->logo,
            'tahun_berdiri' => $input->tahun_berdiri,
            'alamat' => $input->alamat,
            'kota' => $input->kota,
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
}