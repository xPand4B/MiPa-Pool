<?php

namespace App\Providers;

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
        // Send Flash message
        \App\Events\SendFlashMessageEvent::class => [
            \App\Listeners\SendFlashMessageListener::class
        ],

    // OrderController
        // New order has been created
        \App\Events\Orders\NewOrderCreationEvent::class => [
            \App\Listeners\Orders\StoreNewOrderListener::class
        ],

        // New menu has been added to a order
        \App\Events\Orders\NewMenuCreationEvent::class => [
            \App\Listeners\Orders\StoreNewMenuListener::class
        ],

        // Update existing order
        \App\Events\Orders\UpdateOrderEvent::class => [
            \App\Listeners\Orders\UpdateOrderListener::class
        ],
    // end OrderController

    // MenuController
        // Update existing menu
        \App\Events\Menus\UpdateMenuEvent::class => [
            \App\Listeners\Menus\UpdateMenuListener::class
        ],
    // end MenuController

    // ProfileController
        // Load Profile
        \App\Events\Profile\LoadProfileDataEvent::class => [
            \App\Listeners\Profile\LoadProfileDataListener::class,
        ],

        // Profile data has been updated
        \App\Events\Profile\UpdateProfileDataEvent::class => [
            \App\Listeners\Profile\UpdateProfileListener::class,
        ],

        // Avatar has been reset
        \App\Events\Profile\ResetAvatarEvent::class => [
            \App\Listeners\Profile\ResetAvatarListener::class,
        ],
    // end ProfileController
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
