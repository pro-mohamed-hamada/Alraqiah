<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ComplaintRequest;
use App\Http\Resources\ComplaintsResource;
use App\Services\ComplaintService;
use Exception;

class ComplaintReplayController extends Controller
{
    public function __construct(private ComplaintService $complaintService)
    {

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try{
            $filters = $request->all();
            $withRelations = [];
            $complaints = $this->complaintService->getAll(filters: $filters, withRelations: $withRelations);
            return apiResponse(data: ComplaintsResource::collection($complaints));
    
        }catch(Exception $e){
            return apiResponse(message: __('lang.something_went_wrong'), code: 442);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComplaintRequest $request)
    {
        try{
            $complaint = $this->complaintService->store(data: $request->Validated());
            if(!$complaint)
                return apiResponse(message: __('lang.something_went_wrong'));
            return apiResponse(data: new ComplaintsResource($complaint), message: __('lang.success_operation'));
    
        }catch(Exception $e){
            return apiResponse(message: __('lang.something_went_wrong'), code: 442);
        }
        
    }//end of store

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComplaintRequest $request, string $id)
    {
        try{
            $complaint = $this->complaintService->update(id: $id, data: $request->Validated());
            if(!$complaint)
                return apiResponse(message: __('lang.something_went_wrong'));
            return apiResponse(data: new ComplaintsResource($complaint), message: __('lang.success_operation'));
    
        }catch(Exception $e){
            return apiResponse(message: __('lang.something_went_wrong'), code: 442);
        }
        
    }//end of store

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
