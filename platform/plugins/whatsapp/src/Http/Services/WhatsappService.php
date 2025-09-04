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
            $updatedSettings = WhatsappSetting::updateOrCreate(
                [], //When the conditions array is empty, updateOrCreate will attempt to find the very first record in the whatsapp_settings table
                [
                    'ultramsg_whatsapp_token' => $token,
                    'ultramsg_whatsapp_instance_id' => $instanceId,
                ]
            );
            return ['code' => 1, 'data' => $updatedSettings];
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

            $response = $this->ultramsgService->sendImageMessage($to, $base64Image);

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

    public function send_voice($to, $oggBase64Audio): array
    {
        try 
        { 
            $response = $this->ultramsgService->sendVoiceMessage($to, $oggBase64Audio);

            if (is_string($response)) 
            {
                $response = json_decode($response, true);
            }

            if (isset($response['sent']) && $response['sent'] === 'true') {
                return [
                    'code' => 1,
                    'data' => [
                        'message' => $response['message'] ?? 'ok',
                        'id' => $response['id'] ?? null,
                    ],
                    'msg' => 'Voice message sent successfully'
                ];
            }

            if (isset($response['error'])) 
            {
                if (is_string($response['error'])) {
                    return ['code' => 0, 'msg' => $response['error']];
                }
                $errors = [];
                foreach ($response['error'] as $errorItem) {
                    foreach ($errorItem as $field => $msg) {
                        $errors[] = "$field: $msg";
                    }
                }
                return ['code' => 0, 'msg' => implode("; ", $errors)];
            }

            return ['code' => 0, 'msg' => 'Unknown response format'];
        } catch (Throwable $ex) {
            return [
                'code' => 0,
                'msg' => $ex->getMessage(),
                'line' => $ex->getLine()
            ];
        }
    }

    public function get_me($instanceId,$token)
    {
        try 
        {
            $response = $this->ultramsgService->getInstanceMe($instanceId,$token); 
            if (isset($response['Error'])) {
                throw new Exception($response['Error']);
            } 
            return [
                'code' => 1, 
                'data' => $response, 
            ];
        }
        catch(Throwable $th)
        {
            return ['code' => 0, 'msg' => $th->getMessage()];
        }
    }
}
