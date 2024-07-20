<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClientHistoryStoreRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Api\ClientStoreRequest;
use App\Http\Requests\Api\ClientUpdateRequest;
use App\Http\Requests\Api\LocationRequest;
use App\Http\Requests\Api\SubscribeRequest;
use App\Http\Resources\ClientsResource;
use App\Services\ClientService;
use Exception;

class ClientsController extends Controller
{
    public function __construct(private ClientService $clientService)
    {

    }

    public function updateChronicDisease(ClientUpdateRequest $request)
    {
        // try{
            $status = $this->clientService->updateChronicDisease(data: $request->Validated());
            if(!$status)
                return apiResponse(message: __('lang.something_went_wrong'), code: 442);
            return apiResponse(message: __('lang.success_operation'));

        // }catch(Exception $e){
        //     return apiResponse(message: __('lang.something_went_wrong'), code: 442);
        // }

    }//end of location

    public function subscribe(SubscribeRequest $request)
    {
        try{
            $status = $this->clientService->subscribe(data: $request->Validated());
            if(!$status)
                return apiResponse(message: __('lang.something_went_wrong'), code: 442);
            return apiResponse(message: __('lang.success_operation'));

        }catch(Exception $e){
            return apiResponse(message: __('lang.something_went_wrong'), code: 442);
        }

    }//end of location

    public function findByQrcode(string $qrcode = "")
    {
        try{
            $client = $this->clientService->findByQRCode(qrcode: $qrcode);
            if(!$client)
                return apiResponse(message: __('lang.something_went_wrong'), code: 442);
            return apiResponse(data: new ClientsResource($client), message: __('lang.success_operation'));

        }catch(Exception $e){
            return apiResponse(message: $e->getMessage(), code: 442);
        }

    }//end of location

}
