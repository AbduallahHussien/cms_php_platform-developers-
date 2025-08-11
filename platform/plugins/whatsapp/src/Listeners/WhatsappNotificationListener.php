<?php

namespace Botble\Whatsapp\Listeners;

use Botble\Whatsapp\Events\NotificationEvent;
use Botble\Whatsapp\Events\WhatsappNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

// class WhatsappNotificationListener implements ShouldQueue
class WhatsappNotificationListener
{
    use InteractsWithQueue;

    public function handle(WhatsappNotificationEvent $event)
    {
        $payload = $event->data;
        // info('payload');
        // info($payload);
        $whatsappData = $payload['data'] ?? [];

        if (function_exists('whatsapp_insert_chat')) 
        {
            if($whatsappData['type'] == 'image' && $whatsappData['fromMe'] && $payload['event_type'] == 'message_create')
            {
                $whatsappData['media'] = $payload['referenceId'];   
            }

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

        // Handle media download for images if media URL exists
        if (!empty($whatsappData['media']) && $whatsappData['type'] === 'image' && $payload['event_type'] == 'message_received') 
        {
            $imgUrl = $this->downloadWhatsAppMedia($whatsappData['media'], $whatsappData['id']);
           info('imgUrl');
           info($imgUrl);
            if ($imgUrl) {
                $database = app('whatsapp.firebase.database'); 
                $snapshot = $database
                ->getReference('whatsapp_chat')
                ->orderByChild('msg_id')
                ->equalTo($whatsappData['id'])
                ->getSnapshot();
            
                $records = $snapshot->getValue(); 
                if (!$records) {
                    return 'No record found for this msg_id';
                }
                
                // Step 2: Loop through found records (could be more than one)
                foreach ($records as $pushId => $data) {
                    // Step 3: Update media key
                    $database->getReference("whatsapp_chat/{$pushId}/media")
                        ->set($imgUrl);
                }
                
                return 'Media updated successfully';
            }
        }
    }
 

    /**
     * Download media from given URL and save locally in 'public/whatsapp/' folder.
     * Returns the local storage path on success, or null on failure.
     */
    function downloadWhatsAppMedia(string $mediaUrl, string $messageId): ?string
    {
        try {
            // Extract extension or fallback to jpg
            $extension = pathinfo(parse_url($mediaUrl, PHP_URL_PATH), PATHINFO_EXTENSION) ?: 'jpg';
            $fileName = "{$messageId}.{$extension}";
            $filePath = "whatsapp/{$fileName}";
            // Download media
            $response = Http::withOptions(['decode_content' => false])->get($mediaUrl);
            if ($response->successful()) 
            {
                Storage::disk('public')->put($filePath, $response->body()); 
                return Storage::url($filePath); 
            } else {
                Log::warning("Failed to download WhatsApp media.", [
                    'url' => $mediaUrl,
                    'status' => $response->status(),
                ]);
            }
        } catch (Throwable $e) {
            Log::error("Exception while downloading WhatsApp media: {$e->getMessage()}");
        }

        return null;
    }
}
