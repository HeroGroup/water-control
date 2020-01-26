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
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\LevelChanged' => [
            'App\Listeners\NotifyClients',
        ],
        'App\Events\DeviceCreatedOrUpdated' => [
            'App\Listeners\CreateDeviceChangeLog',
        ],
        'App\Events\DeviceSettingCreatedOrUpdated' => [
            'App\Listeners\CreateDeviceSettingChangeLog',
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
