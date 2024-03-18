<?php

namespace App\Http\Controllers\api;

use App\Enum\ActivationStatusEnum;
use App\Enum\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClientsResource;
use App\Http\Resources\ReservationsResource;
use App\Http\Resources\SettingsResource;
use App\Http\Resources\UsersResource;
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
            $data['user_data'] = new UsersResource($user);
            $data['client_data'] = ClientsResource::collection($this->clientService->getAll(filters: ['id'=> $user->client_id], withRelations: ['relatives', 'sites']));
            $data['subscrcibers'] = ClientsResource::collection($this->clientService->getAll(filters: ['parent_id' =>$user->client_id], withRelations: ['user']));
            $data['videos'] = VideosResource::collection($this->videoService->getAll(filters: ['is_active' =>ActivationStatusEnum::ACTIVE]));
            $data['company_data'] = SettingsResource::collection($this->settingService->getAll());
            $finalResult = collect([
                'user_data' => $data['user_data'],
                'client_data' => $data['client_data'],
                'subscriber_data'=> $data['subscrcibers'],
                'videos'=> $data['videos'],
                'company_data'=> $data['company_data'],
            ]);
            return apiResponse(data: $finalResult);
        }else if($user->type == UserTypeEnum::SUPERVISOR)
        {
            $data['user_data'] = new UsersResource($user);
            $data['client_data'] = ClientsResource::collection($user->supervisorClients);
            $data['videos'] = VideosResource::collection($this->videoService->getAll(filters: ['is_active' =>ActivationStatusEnum::ACTIVE]));
            $data['company_data'] = SettingsResource::collection($this->settingService->getAll());
            $finalResult = collect([
                'user_data' => $data['user_data'],
                'client_data' => $data['client_data'],
                'videos'=> $data['videos'],
                'company_data'=> $data['company_data'],
            ]);
            return apiResponse(data: $finalResult);
        }
        else{
            return apiResponse();
        }
            
    }

}
