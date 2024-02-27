<?php

namespace App\Listeners;

use App\Events\AddLike;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementPostLikesCount
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
        $like=$event->like;
        $post=$like->post;
        $post->like_count++;
        $post->save();
    }
}
