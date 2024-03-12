<?php

namespace App\Http\Controllers\Api;

use App\Enum\ActivationStatusEnum;
use App\Enum\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LocationRequest;
use App\Http\Resources\RatesResource;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\Api\RateStoreRequest;
use App\Http\Resources\FaqsResource;
use App\Http\Resources\UsersResource;
use App\Services\FaqService;
use App\Services\UserService;

class UsersController extends Controller
{
    public function __construct(private UserService $userService)
    {

    }

    public function getSupervisors(Request $request)
    {
        try{
            $filters = $request->all();
            $filters['is_active'] = ActivationStatusEnum::ACTIVE;
            $filters['type'] = UserTypeEnum::SUPERVISOR;
            $users = $this->userService->getAll(filters: $filters);
            return apiResponse(data: UsersResource::collection($users));
    
        }catch(Exception $e){
            return apiResponse(message: $e->getMessage(), code: 442);
        }
        
    }//end of 
    
    public function location(LocationRequest $request)
    {
        try{
            $status = $this->userService->location(data: $request->Validated());
            if(!$status)
                return apiResponse(message: __('lang.something_went_wrong'), code: 442);
            return apiResponse(message: __('lang.success_operation'));
    
        }catch(Exception $e){
            return apiResponse(message: __('lang.something_went_wrong'), code: 442);
        }
        
    }//end of location
}
