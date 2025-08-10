<?php

namespace Botble\Whatsapp\Http\Requests;

use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SendWhatsappImageRequest extends Request
{
    public function rules()
    {
        return [
            'to' => [
                'required',
                'regex:/^(\+\d{8,15}|(\d{8,15})(@c\.us|-\d+@g\.us))$/',
            ],
            'image' => [
                'required',
                // Must be valid base64
                function ($attribute, $value, $fail) {
                    if (!preg_match('/^data:image\/(jpg|jpeg|gif|png|webp|bmp);base64,/', $value)) {
                        $fail('The ' . $attribute . ' must be a valid base64 encoded image.');
                        return;
                    }

                    // Remove the base64 prefix
                    $base64Data = substr($value, strpos($value, ',') + 1);

                    // Check max length (characters)
                    if (strlen($base64Data) > 10000000) {
                        $fail('The ' . $attribute . ' may not be greater than 10,000,000 characters.');
                        return;
                    }

                    // Check file size in bytes (16MB max)
                    $sizeInBytes = (int) (strlen($base64Data) * 3 / 4);
                    if ($sizeInBytes > 16 * 1024 * 1024) {
                        $fail('The ' . $attribute . ' may not be greater than 16 MB.');
                        return;
                    }
                }
            ]
        ];
    }
    public function messages()
    {
        return [
            'to.required' => 'The recipient field is required.',
            'to.regex' => 'The recipient must be a valid international phone number or a valid WhatsApp chat ID.',
            'image.required' => 'The image URL is required.', 
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
