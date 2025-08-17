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
use Mimey\MimeTypes; // A recommended library for MIME type mapping


// class WhatsappNotificationListener implements ShouldQueue
class WhatsappNotificationListener
{
    use InteractsWithQueue;

    private function updateMediaOnRTDB($mediaUrl, $id)
    {
        $database = app('whatsapp.firebase.database');
        $snapshot = $database
            ->getReference('whatsapp_chat')
            ->orderByChild('msg_id')
            ->equalTo($id)
            ->getSnapshot();

        $records = $snapshot->getValue();
        if (!$records) {
            info('No record found for this msg_id');
            return false;
        }

        // Step 2: Loop through found records (could be more than one)
        foreach ($records as $pushId => $data) {
            $database->getReference("whatsapp_chat/{$pushId}/media")->set($mediaUrl);
        }

        return true;
    }

    public function handle(WhatsappNotificationEvent $event)
    {
        $payload = $event->data;
        info('payload');
        info($payload);
        $whatsappData = $payload['data'] ?? [];

        if (function_exists('whatsapp_insert_chat')) {
            // if($whatsappData['type'] == 'image' && $whatsappData['fromMe'] && $payload['event_type'] == 'message_create')
            // {
            //     $whatsappData['media'] = $payload['referenceId'];   
            // }

            if ($whatsappData['type'] == 'document') {
                //default body value is caption
                //I did that cause i dont have filename field in RTDB
                $whatsappData['body'] = $whatsappData['filename'];
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
        if (!empty($whatsappData['media'])) {
            $mediaUrl = $this->downloadWhatsAppMedia($whatsappData['media'], $whatsappData['id'], $whatsappData['type'], $payload['event_type']);

            if ($mediaUrl) {
                $res = $this->updateMediaOnRTDB($mediaUrl, $whatsappData['id']);
                if ($res) {
                    info('RTDB updated successfully');
                } else {
                    info('Error in updating media in RTDB');
                }
            }
        }
    }



    function downloadWhatsAppMedia(string $mediaUrl, string $messageId, string $mediaType, string $eventType): ?string
    {
        try {
            // --- Step 1: Set up folder and default extension based on media type ---
            $defaultExtension = '';
            $mediaSubFolder = '';

            switch ($mediaType) {
                case 'image':
                    $defaultExtension = 'jpg';
                    $mediaSubFolder = 'whatsapp-images';
                    break;
                case 'video':  // <-- new case for video
                    $defaultExtension = 'mp4';
                    $mediaSubFolder = 'whatsapp-videos';
                    break;
                case 'ptt': // ptt is push-to-talk (voice note)
                    $defaultExtension = 'ogg'; // WhatsApp often uses .ogg for voice notes
                    $mediaSubFolder = 'whatsapp-voices';
                    break;
                case 'audio': // regular audio file (mp3, aac, etc.)
                    $defaultExtension = 'mp3'; // default common audio format
                    $mediaSubFolder = 'whatsapp-audios';
                    break;
                case 'document':
                    $defaultExtension = 'bin'; // A generic binary default
                    $mediaSubFolder = 'whatsapp-documents';
                    break;
                default:
                    Log::warning("Unsupported WhatsApp media type.", ['mediaType' => $mediaType]);
                    return null; // Exit if media type is not supported
            }

            // --- Step 2: Download the file FIRST to inspect its headers ---
            $response = Http::withOptions(['decode_content' => false])->get($mediaUrl);

            if (!$response->successful()) {
                Log::warning("Failed to download WhatsApp media.", [
                    'url' => $mediaUrl,
                    'status' => $response->status(),
                ]);
                return null;
            }

            // --- Step 3: Determine the REAL file extension from the response ---
            $extension = null;

            // Best method: Check the 'Content-Disposition' header for a filename
            $disposition = $response->header('Content-Disposition');
            if ($disposition && preg_match('/filename="(.+?)"/i', $disposition, $matches)) {
                $extension = pathinfo($matches[1], PATHINFO_EXTENSION);
            }

            // Fallback method: Check the 'Content-Type' header
            if (!$extension) {
                $contentType = $response->header('Content-Type');
                if ($contentType) {
                    // Use a library to reliably convert MIME type to extension
                    $mimes = new MimeTypes();
                    $extension = $mimes->getExtension($contentType);
                }
            }

            // Use the default extension if both methods above fail
            $finalExtension = $extension ?: $defaultExtension;

            // --- Step 4: Build the final filename and path ---
            $fileName = "{$messageId}.{$finalExtension}";
            $sentFolder = ($eventType == 'message_create') ? '/sent' : '';
            $filePath = "whatsapp/media/{$mediaSubFolder}{$sentFolder}/{$fileName}";

            // --- Step 5: Save the file and return its public URL ---
            Storage::disk('public')->put($filePath, $response->body());
            return Storage::url($filePath);
        } catch (Throwable $e) {
            Log::error("Exception while downloading WhatsApp media: {$e->getMessage()}", [
                'trace' => $e->getTraceAsString()
            ]);
        }

        return null;
    }

    /**
     * Download media from given URL and save locally in 'public/whatsapp/' folder.
     * Returns the local storage path on success, or null on failure.
     */
    // function downloadWhatsAppMedia(string $mediaUrl, string $messageId,string $mediaType,string $eventType): ?string
    // {
    //     try 
    //     { 
    //         $defaultExtension = '';
    //         $mediaSubFolder = '';

    //         switch ($mediaType) {
    //             case 'image':
    //                 $defaultExtension = 'jpg';
    //                 $mediaSubFolder = 'whatsapp-images';
    //                 break;
    //             case 'ptt':
    //                 $defaultExtension = 'mp3';
    //                 $mediaSubFolder = 'whatsapp-voices';
    //                 break;
    //             // case 'document':
    //             //     $defaultExtension = 'txt';
    //             //     $mediaSubFolder = 'whatsapp-documents';
    //             //     break;
    //             // It's good practice to handle an unknown case.
    //             default:
    //                 // You might want to throw an exception or log an error here.
    //                 // For this example, we'll just break.
    //                 break;
    //         }

    //         // 2. Now, run the common logic only ONCE.
    //         // This assumes one of the cases above matched.
    //         if ($mediaSubFolder) {
    //             // Get file extension and name
    //             $extension = pathinfo(parse_url($mediaUrl, PHP_URL_PATH), PATHINFO_EXTENSION) ?: $defaultExtension;
    //             $fileName = "{$messageId}.{$extension}";

    //             // Make the HTTP request
    //             $response = Http::withOptions(['decode_content' => false])->get($mediaUrl);

    //             // Determine the final directory path concisely using a ternary operator
    //             $sentFolder = ($eventType == 'message_create') ? '/sent' : '';
    //             $filePath = "whatsapp/media/{$mediaSubFolder}{$sentFolder}/{$fileName}";
    //         }
    //         // Download media
    //         if(in_array($mediaType,['image','ptt','document']))
    //         {
    //             if ($response->successful()) 
    //             {
    //                 Storage::disk('public')->put($filePath, $response->body()); 
    //                 return Storage::url($filePath); 
    //             } else {
    //                 Log::warning("Failed to download WhatsApp media.", [
    //                     'url' => $mediaUrl,
    //                     'status' => $response->status(),
    //                 ]);
    //             }
    //         }
    //         else 
    //         {
    //             return false;
    //         }

    //     } 
    //     catch (Throwable $e) 
    //     {
    //         Log::error("Exception while downloading WhatsApp media: {$e->getMessage()}");
    //     }

    //     return null;
    // }
}
