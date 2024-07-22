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
use App\Http\Requests\Api\UpdateProfileLogoRequest;
use App\Http\Resources\ClientsResource;
use App\Http\Resources\RelativesResource;
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
            return apiResponse(message: $e->getMessage(), code: 442);
        }

    }//end of location

    public function updateProfileLogo($id, UpdateProfileLogoRequest $request): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $relative = $this->relativeService->updateProfileLogo(id: $id, data: $request->Validated());
            return apiResponse(data: new RelativesResource($relative), message: __('lang.success_operation'));
        } catch (\Exception $exception) {
            return apiResponse(message: $exception->getMessage(), code: 422);
        }
    }

}
