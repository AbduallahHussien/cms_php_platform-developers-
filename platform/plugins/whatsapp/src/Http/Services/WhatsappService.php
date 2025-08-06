<?php

namespace Botble\Whatsapp\Services;

use Botble\Whatsapp\Models\WhatsappSetting;
use Throwable;
class WhatsappService
{
    public function save_settings(string $token, string $instanceId ): array
    {
        try 
        {
            WhatsappSetting::updateOrCreate(
                [], //When the conditions array is empty, updateOrCreate will attempt to find the very first record in the whatsapp_settings table
                [
                    'ultramsg_whatsapp_token' => $token,
                    'ultramsg_whatsapp_instance_id' => $instanceId,
                ]
            );
            
            return ['code' => 1, 'data' => true];
        }
        catch(Throwable $ex)
        {
            return ['code' => 0,'msg'=> $ex->getMessage()];
        }
    } 
}
