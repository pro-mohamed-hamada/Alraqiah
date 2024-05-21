<?php

namespace App\Console\Commands;

use App\Enum\FcmEventsNames;
use App\Models\FcmMessage;
use App\Models\ScheduleFcm;
use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClientLaunchDateReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'client:launch-date-remider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //notify the users the complaint created
        $scheduleFcmForLaunchDate  = ScheduleFcm::query()
        ->where('is_active', 1)
        ->whereIn('trigger', [FcmEventsNames::$EVENTS['ONE_DAY_BEFORE_LAUNCH_DATE'],FcmEventsNames::$EVENTS['TWO_DAY_BEFORE_LAUNCH_DATE'], FcmEventsNames::$EVENTS['SEVEN_DAY_BEFORE_LAUNCH_DATE']])
        ->get();

        $scheduleFcmLaunchDateBeforeOneDay = $scheduleFcmForLaunchDate->where('trigger',FcmEventsNames::$EVENTS['ONE_DAY_BEFORE_LAUNCH_DATE'])->first();

        if($scheduleFcmLaunchDateBeforeOneDay)
        {
            $filters['launch_date'] = Carbon::now()->addDay()->format('Y-m-d');
            $users = app()->make(UserService::class)->queryGet(filters: $filters)->get();
            User::SendNotification(fcm: $scheduleFcmLaunchDateBeforeOneDay, users: $users);
        }

        $scheduleFcmLaunchDateBeforeTwoDays = $scheduleFcmForLaunchDate->where('trigger',FcmEventsNames::$EVENTS['TWO_DAY_BEFORE_LAUNCH_DATE'])->first();

        if($scheduleFcmLaunchDateBeforeTwoDays)
        {
            $filters['launch_date'] = Carbon::now()->addDays(2)->format('Y-m-d');
            $users = app()->make(UserService::class)->queryGet(filters: $filters)->get();
            User::SendNotification(fcm: $scheduleFcmLaunchDateBeforeTwoDays, users: $users);
        }

        $scheduleFcmLaunchDateBeforeSevenDays = $scheduleFcmForLaunchDate->where('trigger',FcmEventsNames::$EVENTS['SEVEN_DAY_BEFORE_LAUNCH_DATE'])->first();

        if($scheduleFcmLaunchDateBeforeSevenDays)
        {
            $filters['launch_date'] = Carbon::now()->addDays(7)->format('Y-m-d');
            $users = app()->make(UserService::class)->queryGet(filters: $filters)->get();
            User::SendNotification(fcm: $scheduleFcmLaunchDateBeforeSevenDays, users: $users);
        }

        
    }
}
