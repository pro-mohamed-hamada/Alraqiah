<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ComplaintReplayStoreRequest;
use App\Http\Requests\Api\ComplaintReplayUpdateRequest;
use App\Http\Resources\ComplaintRepliesResource;
use App\Http\Resources\ComplaintsResource;
use App\Services\ComplaintReplayService;
use Exception;

class ComplaintReplayController extends Controller
{
    public function __construct(private ComplaintReplayService $complaintReplayService)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComplaintReplayStoreRequest $request)
    {
        try{
            $complaintReplay = $this->complaintReplayService->store(data: $request->Validated());
            if(!$complaintReplay)
                return apiResponse(message: __('lang.something_went_wrong'));
            return apiResponse(data: new ComplaintRepliesResource($complaintReplay), message: __('lang.success_operation'));
    
        }catch(Exception $e){
            return apiResponse(message: $e->getMessage(), code: 442);
        }
        
    }//end of store

    /**
     * Update the specified resource in storage.
     */
    public function update(ComplaintReplayUpdateRequest $request, string $id)
    {
        try{
            $complaintReplay = $this->complaintReplayService->update(id: $id, data: $request->Validated());
            if(!$complaintReplay)
                return apiResponse(message: __('lang.something_went_wrong'));
            return apiResponse(data: new ComplaintRepliesResource($complaintReplay), message: __('lang.success_operation'));
    
        }catch(Exception $e){
            return apiResponse(message: $e->getMessage(), code: 442);
        }
        
    }//end of store

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $result = $this->complaintReplayService->destroy(id: $id);
            if(!$result)
                return apiResponse(message: __('lang.something_went_wrong'));
            return apiResponse(message: __('lang.success_operation'));
    
        }catch(Exception $e){
            return apiResponse(message:$e->getMessage(), code: 442);
        }
    }
}
