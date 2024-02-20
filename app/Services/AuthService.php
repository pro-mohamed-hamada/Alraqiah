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

    public function loginWithPhone(string $phone, bool $remember = false) :User|Model
    {
        $password = '123456';
        $credential = ['phone'=>$phone, 'password'=>$password, 'type'=>[UserTypeEnum::CLIENT, UserTypeEnum::SUPERVISOR]];
        if (!auth()->attempt(credentials: $credential, remember: $remember))
            return throw new NotFoundException(__('lang.login_failed'));
        $user = User::where('phone', $phone)->first();
        return $user;
    }


    public function startWork($startWorkLat, $startWorklng) :bool
    {
        $user = auth::user();
        $status = $user->activityLogs()->create([
            'start_work_time'=> Carbon::now()->setTimezone('Africa/Cairo'),
            'start_work_lat'=>$startWorkLat,
            'start_work_lng'=>$startWorklng,
        ]);
        if(!$status)
            return false;
        return true;
        
    }
    public function endWork($endWorkLat, $endWorklng) :bool
    {
        $user = auth::user();
        $latestActivityLog = $user->activityLogs->last();
        $startWorkTime = $latestActivityLog->start_work_time;
        $endWorkTime = Carbon::now()->setTimezone('Africa/Cairo');
        $status = $latestActivityLog->update([
            'end_work_time'=> $endWorkTime,
            'hours'=>$endWorkTime->floatDiffInHours($startWorkTime),
            'end_work_lat'=>$endWorkLat,
            'end_work_lng'=>$endWorklng,
        ]);
        if(!$status)
            return false;
        return true;
        
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


    /**
     * @param array $data
     * @return mixed
     */
    public function register(array $data=[]): mixed
    {
        $user = User::create($data);
        ResetCodePassword::sendCode(phone: $data['phone']);
        return $user;
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

    public function updateLogo(array $data)
    {
        $user = Auth::user();
        if (isset($data['logo'])) {
            $user->deleteAttachmentsLogo();
            $fileData = FileService::saveImage(file: $data['logo'], path: 'uploads/users', field_name: 'logo');
            $fileData['type'] = ImageTypeEnum::LOGO;
            $user->storeAttachment($fileData);
        }
        return $user;

    }
    public function setUserFcmToken(User $user , $fcm_token)
    {
        if (isset($fcm_token))
            $user->update(['device_token'=>$fcm_token]);
    }
}
