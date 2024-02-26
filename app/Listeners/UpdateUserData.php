<?php

namespace App\Listeners;

use App\Events\ProfileUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserData
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
    public function handle(ProfileUpdated $event): void
    {
        $profile = $event->user->profile;

        $event->user->update([
            'fullName' => $profile->fullName,
            'phone' => $profile->phone,
            'gender' => $profile->gender,
            'email' => $event->user->email,
        ]);
    }
}
