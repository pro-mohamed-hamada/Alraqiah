<?php

namespace App\Http\Controllers\Api;

use App\Enum\UserTypeEnum;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EndWorkRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\LogoutRequest;
use App\Http\Requests\Api\StartWorkRequest;
use App\Http\Resources\AuthUserResource;
use App\Models\User;
use App\Services\AuthService;
use Exception;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function login(LoginRequest $request)
    {
        try {
            $remember = isset($request->remember) ? $request->remember:0;
            $user = $this->authService->loginWithPhone(phone: $request->phone, deviceToken: $request->device_token, remember: $remember);
            if(!$user->is_active)
                return apiResponse(message: __('lang.unauthorized'), code: 403);
            return apiResponse(data: new AuthUserResource($user), message: __('lang.success_operation'));
        } catch (Exception|NotFoundException $e) {
            return apiResponse(message: $e->getMessage(), code:442);
        }
    }

    public function profile(): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $user = Auth::user();
            
            return apiResponse(data: new AuthUserResource($user), message: __('lang.success_operation'));
        } catch (\Exception $exception) {
            return apiResponse(message: $exception->getMessage(), code: 422);
        }
    }

    public function logout()
    {

        try {
            $status = $this->authService->logout();
            if($status)
                return apiResponse(message: __('lang.success_operation'), code: 200);
        } catch (Exception $e) {
            return apiResponse(message: $e->getMessage(), code:442);
        }
    }

}
