<?php

namespace App\Listeners;

use App\Events\TagPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementTagPostCount
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
    public function handle(TagPost $event): void
    {
        $post = $event->post;
        $tags = $post->tags;
        foreach ($tags as $tag) {
        $tag->post_count++;
        }
        $post->save();
    }
}
