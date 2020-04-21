<?php

namespace App\Providers;

use App\Events\DownLevelEvent;
use App\Events\DropEvent;
use App\Events\DropInEvent;
use App\Events\DropInReview;
use App\Events\DropReview;
use App\Events\ElectiveEvent;
use App\Events\FailedEvent;
use App\Events\ForgetPasswordEvent;
use App\Events\FreshmanMailEvent;
use App\Events\Magazine;
use App\Events\UnreportMailEvent;
use App\Events\UpLevelEvent;
use App\Listeners\DownLevelListener;
use App\Listeners\DropInListener;
use App\Listeners\DropInReviewListener;
use App\Listeners\DropListener;
use App\Listeners\DropReviewListener;
use App\Listeners\ElectiveListener;
use App\Listeners\FailedListener;
use App\Listeners\ForgetPasswordListener;
use App\Listeners\FreshmanMailListener;
use App\Listeners\MagazineListener;
use App\Listeners\UnNoticeListener;
use App\Listeners\UpLevelListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UnreportMailEvent::class => [
            UnNoticeListener::class,
        ],
        FreshmanMailEvent::class => [
            FreshmanMailListener::class,
        ],
        UpLevelEvent::class => [
            UpLevelListener::class,
        ],
        DownLevelEvent::class => [
            DownLevelListener::class,
        ],
        DropEvent::class => [
            DropListener::class,
        ],
        DropReview::class => [
            DropReviewListener::class,
        ],
        DropInEvent::class => [
            DropInListener::class
        ],
        DropInReview::class =>[
            DropInReviewListener::class,
        ],
        ElectiveEvent::class => [
            ElectiveListener::class
        ],
        ForgetPasswordEvent::class => [
            ForgetPasswordListener::class
        ],
        FailedEvent::class => [
            FailedListener::class,
        ],
        Magazine::class => [
            MagazineListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
