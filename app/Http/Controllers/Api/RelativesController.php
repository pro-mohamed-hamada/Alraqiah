<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClientHistoryStoreRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ClientStoreRequest;
use App\Http\Requests\Api\ClientUpdateRequest;
use App\Http\Requests\Api\LocationRequest;
use App\Http\Requests\Api\RelativeUpdateRequest;
use App\Http\Requests\Api\SubscribeRequest;
use App\Http\Resources\ClientsResource;
use App\Services\ClientService;
use App\Services\RelativeService;
use Exception;

class RelativesController extends Controller
{
    public function __construct(private RelativeService $relativeService)
    {

    }

    public function updateChronicDisease($id, RelativeUpdateRequest $request)
    {
        try{
            $status = $this->relativeService->updateChronicDisease(id: $id, data: $request->Validated());
            if(!$status)
                return apiResponse(message: __('lang.something_went_wrong'), code: 442);
            return apiResponse(message: __('lang.success_operation'));

        }catch(Exception $e){
            return apiResponse(message: __('lang.something_went_wrong'), code: 442);
        }

    }//end of location

}
