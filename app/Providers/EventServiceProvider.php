<?php

namespace App\Providers;

use App\Events\TagPost;
use App\Events\AddLike;
use App\Events\PostAdd;
use App\Events\PostComment;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\IncrementTagPostCount;

use App\Events\RemovePostLike;
use App\Listeners\DecrementPostLikeCount;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\IncrementPostCommentCount;
use App\Listeners\IncrementPostCountatUserTable;
use App\Listeners\IncrementPostLikesCount;

use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PostComment::class=>[
            IncrementPostCommentCount::class
        ],
        TagPost::class=>[
            IncrementTagPostCount::class
        ],

        AddLike::class=>[
            IncrementPostLikesCount::class
        ],
        RemovePostLike::class=>[
            DecrementPostLikeCount::class
        ],
        PostAdd::class=>[
            IncrementPostCountatUserTable::class
        ]

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
