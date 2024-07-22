<?php

namespace App\Enum;

class FcmEventsNames
{
    public static array $EVENTS = [
        'ONE_DAY_BEFORE_LAUNCH_DATE'   => 'ONE_DAY_BEFORE_LAUNCH_DATE',
        'TWO_DAY_BEFORE_LAUNCH_DATE'   => 'TWO_DAY_BEFORE_LAUNCH_DATE',
        'SEVEN_DAY_BEFORE_LAUNCH_DATE' => 'SEVEN_DAY_BEFORE_LAUNCH_DATE',

    ];

    public static array $FCMACTIONS = [
        'CREAET_NEW_COMPLAINT'            => 'create_new_complaint',
        'SUPERVISOR_REPLIED_ON_COMPLAINT' => 'supervisor_replied_on_complaint',
        'CLIENT_LOGIN' => 'client_login',
        'CLIENT_OUTSIDE_LIMIT' => 'client_outside_limit',
    ];

    public static array $FLAGS = [
        '@USER_NAME@'=>'@USER_NAME@',
        '@USER_PHONE@'=>'@USER_PHONE@',
        '@RESERVATION_NUMBER@'=>'@RESERVATION_NUMBER@',
        '@PACKAGE@'=>'@PACKAGE@',
        '@LAUNCH_DATE@'=>'@LAUNCH_DATE@',
        '@GENDER@'=>'@GENDER@',
        '@IDENTITY_NUMBER@'=>'@IDENTITY_NUMBER@',
    ];

    public static array $CHANNELS = [
        'fcm'=>'fcm',
        // 'mail'=>'mail',
    ];
}
