<?php

namespace Botble\Gift\Http\Requests;

use Botble\Support\Http\Requests\Request;

class GiftReplyRequest extends Request
{
    public function rules(): array
    {
        return [
            'message' => 'required|string|max:1500',
        ];
    }
}
