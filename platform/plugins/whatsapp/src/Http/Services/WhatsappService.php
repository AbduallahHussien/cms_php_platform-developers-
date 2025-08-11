<?php

namespace Botble\Whatsapp\Http\Services;

use Botble\Whatsapp\Models\WhatsappSetting;
use Exception;
use Throwable;
use Illuminate\Support\Facades\Storage;


class WhatsappService
{
    public function __construct(protected UltramsgService $ultramsgService) {}
    public function save_settings(string $token, string $instanceId): array
    {
        try {
            WhatsappSetting::updateOrCreate(
                [], //When the conditions array is empty, updateOrCreate will attempt to find the very first record in the whatsapp_settings table
                [
                    'ultramsg_whatsapp_token' => $token,
                    'ultramsg_whatsapp_instance_id' => $instanceId,
                ]
            );

            return ['code' => 1, 'data' => true];
        } catch (Throwable $ex) {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }


    private function replaceDomainAuto(string $oldUrl, string $newDomain): string
    {
        // Parse the old URL
        $parsedUrl = parse_url($oldUrl);
    
        // Get the path and query if exists
        $path = $parsedUrl['path'] ?? '';
        $query = isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '';
    
        // Make sure $newDomain has no trailing slash
        $newDomain = rtrim($newDomain, '/');
    
        // Compose new URL
        return $newDomain . $path . $query;
    }
    

    
    public function send_img($to, $base64Image): array
    {
        try {

            $imgUrl = null;

            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $imageData = substr($base64Image, strpos($base64Image, ',') + 1);
                $imageData = base64_decode($imageData);
                $extension = strtolower($type[1]);
                $filename = uniqid() . '.' . $extension;
                $filePath = "whatsapp/{$filename}";
                Storage::disk('public')->put($filePath, $imageData);
                $imgUrl = Storage::url($filePath);
            
                // $url can now be saved to DB or returned
            } else {
                throw new Exception('Invalid image data');
            }


            if(!$imgUrl)
            {
                throw new Exception('imgUrl is required');
            }

            // $newDomain = 'https://d1d59fb97fb9.ngrok-free.app';
            // $newUrl = $this->replaceDomainAuto($imgUrl, $newDomain);
            
            // info('newUrl');
            // info($newUrl);

            $response = $this->ultramsgService->sendImageMessage($to, $imgUrl,'',0,$imgUrl); 
 
            if (is_string($response)) { 
                $response = json_decode($response, true); 
            } 
            if (isset($response['sent']) && $response['sent'] === 'true') { 
                return [
                    'code' => 1,
                    'data' => [
                        'message' => $response['message'] ?? 'ok',
                        'id' => $response['id'] ?? null,
                    ],
                    'msg' => 'Image is sent successfully'
                ]; 
            }
            
            if (isset($response['error'])) {  

                if (is_string($response['error'])) {
                    return [
                        'code' => 0,
                        'msg' => $response['error']
                    ];
                }
                
                $errors = [];
                foreach ($response['error'] as $errorItem) {
                    // $errorItem is like ['image' => 'file extension not supported']
                    foreach ($errorItem as $field => $msg) {
                        $errors[] = "$field: $msg";
                    }
                }
                
                return [
                    'code' => 0,
                    'msg' => implode("; ", $errors)
                ];
            }
             
            // Unexpected response format
            return [
                'code' => 0,
                'msg' => 'Unknown response format'
            ];
        } catch (Throwable $ex) {
            return [
                'code' => 0,
                'msg' => $ex->getMessage(),
                'line' => $ex->getLine()
            ];
        }
    }
}
