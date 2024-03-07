<?php

namespace App\Listeners;

use App\Enum\FcmEventsNames;
use App\Events\PushEvent;
use App\Models\FcmMessage;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotification
{
    /**
     * Create the event listener.
     */
    public function __construct(PushEvent $event)
    {

        $fcmMessage = FcmMessage::query()->where('is_active',true)->where('fcm_action', $event->action)->first();
        if (!$fcmMessage)
            return;
        User::SendNotification(fcm: $fcmMessage, users: $event->users);
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        //
    }
}
