<?php

namespace App\Listeners;

use App\Events\PostAdd;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementPostCountatUserTable
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
    public function handle(PostAdd $event): void
    {
        $user=$event->post->user;
        $user->posts_count++;
        $user->save();
    }
}
