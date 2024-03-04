<?php

namespace App\Models;

use App\Enum\FcmEventsNames;
use App\Services\NotificationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Filterable;
use App\Traits\IsActiveTrait;

class ScheduleFcm extends Model
{
    use HasFactory, Filterable, IsActiveTrait;

    protected $fillable = [
        'title',
        'content',
        'trigger',
        'notification_via',
        'is_active',
    ];

    public static function UserReminderFcm(ScheduleFcm $scheduleFcm, $users)
    {

        //prepare data
        $title = $scheduleFcm->title ;
        $body = $scheduleFcm->content ;
        foreach($users as $user)
        {
            $replaced_values = [
                '@USER_NAME@'=>$user->name,
            ];
            $body = replaceFlags($body,$replaced_values);
            $tokens[0] = $user->device_token;
            app()->make(NotificationService::class)->sendToTokens(title: $title,body: $body,tokens: $tokens);

        }

    }

    public static function sendNotification(array $users, ScheduleFcm $scheduleFcm)
    {
        // $title = $scheduleFcm->title ;
        $body = $scheduleFcm->content ;
        foreach($users as $user)
        {
            $replaced_values = [
                '@USER_NAME@'=>$user->name,
            ];
            $body = replaceFlags($body,$replaced_values);
            $tokens[0] = $user->device_token;
            if($scheduleFcm->notification_via == FcmEventsNames::$CHANNELS['fcm'])
                ScheduleFcm::UserReminderFcm($scheduleFcm, $user);
            // else if($scheduleFcm->notification_via == FcmEventsNames::$CHANNELS['sms'])
            //     app()->make(SmsService::class)->sendSMS(phones: $user->phone, message: $body);
            // else
            //     $user->notify(new \App\Notifications\SendEmailNotification(message: $body));
        }
    }

}
