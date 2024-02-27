<?php

namespace App\Listeners;

use App\Events\RemovePostLike;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecrementPostLikeCount
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
    public function handle(RemovePostLike $event): void
    {
        $post=$event->like->post;
        $post->like_count--;
        $post->save();
    }
}
