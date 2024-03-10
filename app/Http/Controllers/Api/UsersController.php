<?php

namespace App\Http\Controllers\Api;

use App\Enum\ActivationStatusEnum;
use App\Enum\UserTypeEnum;
use App\Http\Controllers\Controller;
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

    public function __invoke(Request $request)
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
        
    }//end of index
}
