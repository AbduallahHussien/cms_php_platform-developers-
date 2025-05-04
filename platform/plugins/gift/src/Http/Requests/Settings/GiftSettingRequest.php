<?php

namespace Botble\Gift\Http\Requests\Settings;

use Botble\Support\Http\Requests\Request;
class GiftSettingRequest extends Request
{
   public function rules(): array
        {
            return [
            'ultra_message_app_url' => ['nullable','string'],
            'ultra_message_instance' =>  ['nullable','string'],
            'ultra_message_token' =>  ['nullable','string'],
            'donor_message'=> ['nullable','string'],
            'recipient_message'=> ['nullable','string'],
        ];

    }



   

   
}
