<?php

namespace App\Services;

use App\Enum\ImageTypeEnum;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\NotFoundException;
use App\Enum\UserTypeEnum;
use App\Events\PushEvent;
use App\Models\FcmMessage;
use Carbon\Carbon;

use function Laravel\Prompts\password;

class AuthService extends BaseService
{

    public function loginWithPhone(string $phone, string $deviceToken = null, bool $remember = false) :User|Model
    {
        $user = User::where('phone', $phone)->whereIn('type', [UserTypeEnum::CLIENT, UserTypeEnum::SUPERVISOR])->first();

        if ($user) {
            // Log the user in
            Auth::login(user: $user, remember: $remember);
            $user->device_token = $deviceToken;
            $user->save();
            
            //notify the users the complaint created
            $users[0] = $user;
            event(new PushEvent( users: $users, action: FcmMessage::CLIENT_LOGIN));

            return $user;
        }

        return throw new NotFoundException(__('lang.login_failed'));
    }

    public function checkPhone(string $phone) :bool
    {
        $user = User::where('phone', $phone)->whereIn('type', [UserTypeEnum::CLIENT, UserTypeEnum::SUPERVISOR])->first();

        if ($user) 
            return true;

        return false;
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
