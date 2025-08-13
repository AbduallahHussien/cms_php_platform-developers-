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
                'file',
                'mimes:ogg,webm,mp3,wav',
                'max:16384', // 16MB
            ],
        ];
    }

    public function messages()
    {
        return [
            'to.required' => 'The recipient field is required.',
            'to.regex' => 'The recipient must be a valid international phone number or a valid WhatsApp chat ID.',
            'audio.required' => 'The audio file is required.',
            'audio.file' => 'The audio must be a valid file.',
            'audio.mimes' => 'The audio must be a file of type: ogg, webm, mp3, wav.',
            'audio.max' => 'The audio may not be greater than 16 MB.',
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
