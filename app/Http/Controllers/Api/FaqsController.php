<?php

namespace App\Http\Controllers\Api;

use App\Enum\ActivationStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\RatesResource;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Api\RateStoreRequest;
use App\Http\Resources\FaqsResource;
use App\Services\FaqService;

class FaqsController extends Controller
{
    public function __construct(private FaqService $faqService)
    {

    }

    public function __invoke(Request $request)
    {
        try{
            $filters = $request->all();
            $filters['is_active'] = ActivationStatusEnum::ACTIVE;
            $rates = $this->faqService->getAll(filters: $filters);
            return apiResponse(data: FaqsResource::collection($rates));
    
        }catch(Exception $e){
            return apiResponse(message: $e->getMessage(), code: 442);
        }
        
    }//end of index
}
