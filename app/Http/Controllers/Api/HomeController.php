<?php

namespace App\Http\Controllers\api;

use App\Enum\ActivationStatusEnum;
use App\Enum\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientsResource;
use App\Http\Resources\ReservationsResource;
use App\Http\Resources\SettingsResource;
use App\Http\Resources\VideosResource;
use App\Services\ClientService;
use App\Services\MediaService;
use App\Services\SettingService;
use App\Services\VideoService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(private ClientService $clientService, private VideoService $videoService, private SettingService $settingService)
    {
        
    }
    public function __invoke(Request $request)//: \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $user = auth('sanctum')->user();
        if($user->type == UserTypeEnum::CLIENT)
        {
            $data['client_data'] = ClientsResource::collection($this->clientService->getAll(filters: ['id'=> $user->client_id], withRelations: ['relatives']));
            $data['subscrcibers'] = ClientsResource::collection($this->clientService->getAll(filters: ['parent_id' =>$user->client_id], withRelations: ['user']));
            $data['videos'] = VideosResource::collection($this->videoService->getAll(filters: ['is_active' =>ActivationStatusEnum::ACTIVE]));
            $data['company_data'] = SettingsResource::collection($this->settingService->getAll());
            $finalResult = collect([
                'client_data' => $data['client_data'],
                'subscriber_data'=> $data['subscrcibers'],
                'videos'=> $data['videos'],
                'company_data'=> $data['company_data'],
            ]);
            return apiResponse(data: $finalResult);
        }else{
            return apiResponse();
        }
            
    }

    public function search(Request $request)//: \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        // $filters = $request->all();
        // $filters['in_duration'] = 1;
        // $filters['is_active']   = 1;
        // $product = $this->productService->queryGet(where_condition: $filters, withRelation: ['defaultLogo'])->select(['id','name'])->limit(10)->get();
        // $center  = $this->centerService->queryGet(where_condition:  $filters, withRelation: ['defaultLogo'])->select(['id','name'])->limit(10)->get();
        // $device  = $this->deviceService->queryGet(where_condition:  $filters, withRelation: ['center', 'defaultImage'])->select(['id','name'])->limit(10)->get();
        // $package = $this->packageService->queryGet(where_condition: $filters, withRelation: ['center', 'attachments'])->limit(10)->get();
        // $doctor = $this->doctorService->queryGet(filters: $filters, withRelation: ['center', 'defaultLogo'])->limit(10)->get();

        // $finalResult = collect([
        //     $product,
        //     $center,
        //     $device,
        //     $package,
        //     $doctor,
        // ]);
        // $search_results = new HomeSearchResource($finalResult);
        // return apiResponse(data: $search_results);
    }

}
