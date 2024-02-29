<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Http\Resources\WebsitesResource;
use App\Services\WebsiteService;

class WebsitesController extends Controller
{
    public function __construct(private WebsiteService $websiteService)
    {

    }

    public function __invoke(Request $request)
    {
        try{
            $filters = $request->all();
            $filters['is_active'] = ActivationStatusEnum::ACTIVE;
            $websites = $this->websiteService->getAll(filters: $filters);
            return apiResponse(data: WebsitesResource::collection($websites));
    
        }catch(Exception $e){
            return apiResponse(message: $e->getMessage(), code: 442);
        }
        
    }//end of index
}
