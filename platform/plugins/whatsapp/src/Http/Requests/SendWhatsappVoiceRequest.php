<?php

namespace Botble\Whatsapp\Http\Requests;

use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SendWhatsappVoiceRequest extends Request
{
    public function rules()
    {
        return [
            'to' => [
                'required',
                'regex:/^(\+\d{8,15}|(\d{8,15})(@c\.us|-\d+@g\.us))$/',
            ],
            'audio' => [
                'required',
                function ($attribute, $value, $fail) {
                    // 1. If it's a public HTTP URL
                    if (filter_var($value, FILTER_VALIDATE_URL)) {
                        if (!preg_match('/\.(ogg|webm|m4a)$/i', parse_url($value, PHP_URL_PATH))) {
                            $fail("The {$attribute} must be an .ogg, .webm, or .m4a file.");
                        }
                        return;
                    }

                    // 2. If it's base64 (Opus codec)
                    if (preg_match('/^data:audio\/(ogg|webm|m4a)(;codecs=opus)?;base64,/', $value)) {
                        
                        $base64Data = substr($value, strpos($value, ',') + 1);

                        // Max base64 length: 10,000,000 characters
                        if (strlen($base64Data) > 10000000) {
                            $fail("The {$attribute} may not be greater than 10,000,000 characters.");
                            return;
                        }

                        // Max file size: 16MB
                        $sizeInBytes = (int) (strlen($base64Data) * 3 / 4);
                        if ($sizeInBytes > 16 * 1024 * 1024) {
                            $fail("The {$attribute} may not be greater than 16 MB.");
                            return;
                        }

                        return;
                    }

                    // 3. Otherwise invalid
                    $fail("The {$attribute} must be a valid public HTTP URL or a base64-encoded Opus audio file.");
                }
            ]
        ];
    }

    public function messages()
    {
        return [
            'to.required' => 'The recipient field is required.',
            'to.regex' => 'The recipient must be a valid international phone number or a valid WhatsApp chat ID.',
            'audio.required' => 'The audio file or URL is required.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors(),
        ], 422));
    }
}
