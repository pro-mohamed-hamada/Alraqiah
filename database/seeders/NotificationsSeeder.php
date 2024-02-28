<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use App\Models\Relative;
use App\Models\User;
use App\Notifications\GeneralNotification;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::find(3);
        $user->notify(new GeneralNotification([
            'title'=>'title 1',
            'content'=>'notificaton 1',
        ]));
        $user->notify(new GeneralNotification([
            'title'=>'title 2',
            'content'=>'notification 2',
        ]));
        $user->notify(new GeneralNotification([
            'title'=>'title 3',
            'content'=>'notificaton 3',
        ]));
        $user->notify(new GeneralNotification([
            'title'=>'title 4',
            'content'=>'notificaton 5',
        ]));
    
    }
}
