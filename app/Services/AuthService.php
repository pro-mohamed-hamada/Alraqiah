<?php

namespace App\Services;

use App\Enum\ImageTypeEnum;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\NotFoundException;
use App\Enum\UserTypeEnum;
use Carbon\Carbon;

use function Laravel\Prompts\password;

class AuthService extends BaseService
{

    public function loginWithPhone(string $phone, string $deviceToken = null, bool $remember = false) :User|Model
    {
        $password = '123456';
        $credential = ['phone'=>$phone, 'password'=>$password, 'type'=>[UserTypeEnum::CLIENT, UserTypeEnum::SUPERVISOR]];
        if (!auth()->attempt(credentials: $credential, remember: $remember))
            return throw new NotFoundException(__('lang.login_failed'));
        $user = User::where('phone', $phone)->first();
        $user->device_token = $deviceToken;
        $user->save();
        return $user;
    }

    public function userTarget() //:User|Model|bool
    {
        $user = auth::user();
        if(!$user)
            return false;
        return $user->load('targets');
    }

    

    public function logout(): bool
    {
        $user =  auth::user();
        Auth::user()->tokens()->delete();
        return true;
    }

    public function getAuthUser()
    {
        return auth('sanctum')->user();
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function updateProfileLogo(array $data)
    {
        $user = Auth::user();
        if (isset($data['logo']))
        {
            $user->clearMediaCollection('users');
            $user->addMediaFromRequest('logo')->toMediaCollection('users');
        }
        return $user;

    }
}
