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
        $tag=$event->tag;
        $tag->post_count++;
        $tag->save();
    }
}
