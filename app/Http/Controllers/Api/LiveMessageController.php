<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\LiveMessageRequest;
use App\Http\Requests\Api\LiveMessageStoreRequest;
use App\Http\Resources\LiveMessagesResource;
use App\Services\LiveMessageService;
use Exception;

class LiveMessageController extends Controller
{
    public function __construct(private LiveMessageService $liveMessageService)
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
            $liveMessages = $this->liveMessageService->getAll(filters: $filters, withRelations: $withRelations);
            return apiResponse(data: LiveMessagesResource::collection($liveMessages));

        }catch(Exception $e){
            return apiResponse(message: $e->getMessage(), code: 442);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LiveMessageStoreRequest $request)
    {
        try{
            $liveMessage = $this->liveMessageService->store(data: $request->all());
            if(!$liveMessage)
                return apiResponse(message: __('lang.something_went_wrong'));
            return apiResponse(data: new LiveMessagesResource($liveMessage), message: __('lang.success_operation'));

        }catch(Exception $e){
            return apiResponse(message: $e->getMessage(), code: 442);
        }

    }//end of store

}
