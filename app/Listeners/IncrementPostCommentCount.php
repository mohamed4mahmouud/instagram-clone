<?php

namespace App\Listeners;

use App\Events\PostComment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementPostCommentCount
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
        $comment=$event->comment;
        $post=$comment->post;
        $post->comments_count++;
        $post->save();
    }
}
