<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FactorExplanationConfig;
use Illuminate\Contracts\View\View;
use App\Traits\BaseModel;
use App\Traits\ApiResponser;
use App\Services\FactorExplanationConfigService;
use App\Http\Requests\Question\Index;
use App\Http\Resources\FactorExplanationConfig\Collection as FactorExplanationConfigCollection;
use App\Http\Resources\FactorExplanationConfig\Resource as FactorExplanationConfigResource;
use DB;
Use Seccion;
use Auth;
use App\Http\Requests\FactorExplanationConfig\Request as FactorExplanationRequest;


class FactorExplanationConfigController extends Controller
{
    use ApiResponser, BaseModel;

    /**
     * Display a listing of the resource.
     */
    
    public function __construct(public FactorExplanationConfigService $factorService) {
        
    }


    public function index(Request $request)
    {
        // Collections 
        $factors = $this->factorService->collection($request->all());
        return $this->collection(new FactorExplanationConfigCollection($factors));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FactorExplanationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,Request $request)
    {
        $factorObjObj = $this->factorService->resource($id, $request->all());
        return isset($factorObjObj['errors']) ? $this->error($factorObjObj) : new FactorExplanationConfigResource($factorObjObj);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, FactorExplanationRequest $request)
    {
        $factorObj = $this->factorService->update($id, $request->all());
        return isset($factorObj['errors']) ? $this->error($factorObj) : $this->success($factorObj, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $factorObj = $this->factorService->destroy($id);
        return $this->success($factorObj, 200);
    }
}
