<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use App\Models\Relative;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Notification::create([
            'user_id'=>3,
            'title'=>'title 1',
            'content'=>'notificaton 1',
        ]);
        Notification::create([
            'user_id'=>3,
            'title'=>'title 2',
            'content'=>'notification 2',
        ]);
        Notification::create([
            'user_id'=>4,
            'title'=>'title 1',
            'content'=>'notificaton 1',
        ]);
        Notification::create([
            'user_id'=>4,
            'title'=>'title 2',
            'content'=>'notification 2',
        ]);
    }
}
