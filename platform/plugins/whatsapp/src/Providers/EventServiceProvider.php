<?php

namespace Botble\Whatsapp\Providers;

use Botble\Whatsapp\Events\NotificationEvent;
use Botble\Whatsapp\Listeners\WhatsappNotificationListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Botble\Whatsapp\Events\WhatsappNotificationEvent;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        WhatsappNotificationEvent::class => [
            WhatsappNotificationListener::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
