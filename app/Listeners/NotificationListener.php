<?php

namespace App\Listeners;

use App\Events\SendNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Notification;
class NotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendNotification $event): void
    {
       
        
        $notification = new Notification;
        $notification->title = $event->notificationData['notification']['title'];
        $notification->description = $event->notificationData['notification']['description'];
        $notification->type = $event->notificationData['notification']['type'];
        $notification->user_id = $event->notificationData['user']->id;
        $notification->save();
    }
}
