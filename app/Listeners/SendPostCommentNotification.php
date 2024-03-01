<?php

namespace App\Listeners;

use App\Events\PostComment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\NotificationCommentAdded;

class SendPostCommentNotification
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
    public function handle(PostComment $event): void
    {
        $user = $event->comment->user;
        $user->notify(new NotificationCommentAdded ($event->comment));
    }
}
