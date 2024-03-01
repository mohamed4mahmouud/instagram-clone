<?php

namespace App\Listeners;

use App\Events\AddLike;
use App\Notifications\NotificationLikeAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPostLikeNotification
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
    public function handle(AddLike $event): void
    {
        $user = $event->like->user;
        $user->notify(new NotificationLikeAdded ($event->like));
    }
}
