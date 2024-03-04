<?php

namespace App\Http\Controllers\Api;

use App\Enum\ActivationStatusEnum;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Http\Resources\SitesResource;
use App\Services\SiteService;

class SitesController extends Controller
{
    public function __construct(private SiteService $siteService)
    {

    }

    public function __invoke(Request $request)
    {
        try{
            $filters = $request->all();
            $filters['is_active'] = ActivationStatusEnum::ACTIVE;
            $sites = $this->siteService->getAll(filters: $filters);
            return apiResponse(data: SitesResource::collection($sites));
    
        }catch(Exception $e){
            return apiResponse(message: $e->getMessage(), code: 442);
        }
        
    }//end of index
}
