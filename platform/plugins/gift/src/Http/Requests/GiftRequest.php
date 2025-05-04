<?php

namespace Botble\Gift\Http\Requests;

use Botble\Base\Rules\EmailRule;
use Botble\Base\Rules\PhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class GiftRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
 /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'projectName' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:80'],
            'donorName' => ['required', 'string', 'max:1000'],
            'donorPhone' => ['required'],
            'recipientName' => ['required', 'string', 'max:500'],
            'recipientPhone' => ['required', 'string', 'max:500'],
            'messageTemplate'=> ['required', 'string', 'max:500'],
        ];

        return $rules ;
    }

   

    
    

    

   
}
