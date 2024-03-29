<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\FcmEventsNames;
use App\Services\NotificationService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\EscapeUnicodeJson;
use App\Traits\Filterable;
use App\Traits\IsActiveTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, Filterable, EscapeUnicodeJson, InteractsWithMedia, IsActiveTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'type',
        'lat',
        'lng',
        'is_active',
        'client_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getToken(): string
    {
        return $this->createToken(config('app.name'))->plainTextToken;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function client(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function supervisorClients(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Client::class,  'supervisor_id');
    }


    public static function SendNotification(ScheduleFcm|FcmMessage $fcm, $users)
    {

        //prepare data
        $title = $fcm->title ;
        $body = $fcm->content ;
        foreach($users as $user)
        {
            $replaced_values = [
                '@USER_NAME@'=>$user->name,
                '@USER_PHONE@'=>$user->phone,
                '@RESERVATION_NUMBER@'=>$user->client?->reservation_number,
                '@PACKAGE@'=>$user->client?->package,
                '@LAUNCH_DATE@'=>$user->client?->launch_date,
                '@GENDER@'=>$user->client?->gender,
                '@IDENTITY_NUMBER@'=>$user->client?->identity_number,
            ];
            $body = replaceFlags($body,$replaced_values);
            $tokens[0] = $user->device_token;

            // check the notification channel
            if($fcm->notification_via == FcmEventsNames::$CHANNELS['fcm'])
                app()->make(NotificationService::class)->sendToTokens(title: $title,body: $body,tokens: $tokens);
            else
                $user->notify(new \App\Notifications\AlraqiahEmail(title: $title, content: $body));
            
            $user->notify(new \App\Notifications\GeneralNotification(title: $title, content: $body));

        }

    }

}
