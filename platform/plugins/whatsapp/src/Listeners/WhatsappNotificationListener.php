<?php

namespace Botble\Whatsapp\Listeners;

use Botble\Whatsapp\Events\NotificationEvent;
use Botble\Whatsapp\Events\WhatsappNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

// class WhatsappNotificationListener implements ShouldQueue
class WhatsappNotificationListener
{
    use InteractsWithQueue;

    public function handle(WhatsappNotificationEvent $event)
    {
        $payload = $event->data;
        info($payload);
    
        // Split main and nested data
        $whatsappData = $payload['data'] ?? [];
    
        if (function_exists('whatsapp_insert_chat')) {
            whatsapp_insert_chat(
                $payload['instanceId'] ?? null,
                $payload['event_type'] ?? null,
                $payload['referenceId'] ?? '',
                $whatsappData['id'] ?? '',
                $whatsappData['from'] ?? null,
                $whatsappData['to'] ?? null,
                $whatsappData['author'] ?? null,
                $whatsappData['pushname'] ?? null,
                $whatsappData['ack'] ?? null,
                $whatsappData['type'] ?? null,
                $whatsappData['body'] ?? null,
                $whatsappData['media'] ?? null,
                $whatsappData['fromMe'] ?? null,
                $whatsappData['self'] ?? null,
                $whatsappData['isForwarded'] ?? null,
                $whatsappData['time'] ?? now()->timestamp,   // ✅ correct field is `time`, not `timestamp`
                $whatsappData['location']['address'] ?? null,
                $whatsappData['location']['latitude'] ?? null,
                $whatsappData['location']['longitude'] ?? null
            );
        }
    }
    
}
