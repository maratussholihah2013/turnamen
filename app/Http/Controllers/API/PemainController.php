<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Pemain;
use Validator;
use App\Http\Resources\PemainResource;
   
class PemainController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pemains = Pemain::all();
    
        return $this->sendResponse(PemainResource::collection($pemains), 'Pemain retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pemain = $request->all();
   
        $validator = Validator::make($input, [
            'nama' => 'required|string',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'posisi' => 'required|in:penyerang,gelandang,bertahan,penjaga gawang',
            'nomor_punggung' => 'required|numeric|min:1|unique:pemains,nomor_punggung,null,id,tim_id,null',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $product = Product::create($pemain);
   
        return $this->sendResponse(new PemainResource($product), 'Pemain created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pemain = Pemain::find($id);
  
        if (is_null($pemain)) {
            return $this->sendError('Pemain not found.');
        }
   
        return $this->sendResponse(new PemainResource($pemain), 'Pemain retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemain $pemain)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'nama' => 'required|string',
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'posisi' => 'required|in:penyerang,gelandang,bertahan,penjaga gawang',
            'nomor_punggung' => 'required|numeric|min:1|unique:pemains,nomor_punggung,'.$this->id.',id,tim_id,null',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $pemain->update([
            'nama' => $input->nama,
            'tinggi_badan' => $input->tinggi_badan,
            'berat_badan' => $input->berat_badan,
            'posisi' => $input->posisi,
            'nomor_punggung' => $input->nomor_punggung,
        ]);
        $pemain->save();
   
        return $this->sendResponse(new PemainResource($pemain), 'Pemain updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemain $pemain)
    {
        $pemain->delete();
   
        return $this->sendResponse([], 'Pemain deleted successfully.');
    }
}