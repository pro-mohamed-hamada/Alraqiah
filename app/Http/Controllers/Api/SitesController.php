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
            $user = auth('sanctum')->user();
            $filters = $request->all();
            $filters['is_active'] = ActivationStatusEnum::ACTIVE;
            $sites = $user->client->sites;
            return apiResponse(data: SitesResource::collection($sites));
    
        }catch(Exception $e){
            return apiResponse(message: $e->getMessage(), code: 442);
        }
        
    }//end of index
}
