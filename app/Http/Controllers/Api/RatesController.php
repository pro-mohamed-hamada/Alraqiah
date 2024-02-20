<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RatesResource;
use App\Services\RateService;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Api\RateStoreRequest;

class RatesController extends Controller
{
    public function __construct(private RateService $rateService)
    {

    }

    public function index(Request $request)
    {
        try{
            $filters = $request->all();
            $withRelations = [];
            $rates = $this->rateService->getAll(filters: $filters, withRelations: $withRelations);
            return apiResponse(data: RatesResource::collection($rates));
    
        }catch(Exception $e){
            return apiResponse(message: __('lang.something_went_wrong'), code: 442);
        }
        
    }//end of index

    public function store(RateStoreRequest $request)
    {
        try{
            $rate = $this->rateService->store(data: $request->Validated());
            if(!$rate)
                return apiResponse(message: __('lang.something_went_wrong'));
            return apiResponse(data: new RatesResource($rate), message: __('lang.success_operation'));
    
        }catch(Exception $e){
            return apiResponse(message: __('lang.something_went_wrong'), code: 442);
        }
        
    }//end of store
}
