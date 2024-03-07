<?php

namespace App\Enum;

class FcmEventsNames
{
    public static array $EVENTS = [
        'ONE_DAY_BEFORE_LAUNCH_DATE'   => 'one_day_pefore_launch_date',
        'TWO_DAY_BEFORE_LAUNCH_DATE'   => 'two_day_pefore_launch_date',
        'SEVEN_DAY_BEFORE_LAUNCH_DATE' => 'seven_day_pefore_launch_date',

    ];

    public static array $FCMACTIONS = [
        'CREAET_NEW_COMPLAINT'            => 'create_new_complaint',
        'CLIENT_REPLIED_ON_COMPLAINT'     => 'client_replied_on_complaint',
        'SUPERVISOR_REPLIED_ON_COMPLAINT' => 'supervisor_replied_on_complaint',
    ];

    public static array $FLAGS = [
        '@USER_NAME@'=>'@USER_NAME@',
        '@USER_PHONE@'=>'@USER_PHONE@',
        '@RESERVATION_NUMBER@'=>'@RESERVATION_NUMBER@',
        '@RESERVATION_STATUS@'=>'@RESERVATION_STATUS@',
        '@PACKAGE@'=>'@PACKAGE@',
        '@LAUNCH_DATE@'=>'@LAUNCH_DATE@',
        '@GENDER@'=>'@GENDER@',
        '@NATIONAL_NUMBER@'=>'@NATIONAL_NUMBER@',
    ];

    public static array $CHANNELS = [
        'fcm'=>'fcm',
        'mail'=>'mail',
    ];
}