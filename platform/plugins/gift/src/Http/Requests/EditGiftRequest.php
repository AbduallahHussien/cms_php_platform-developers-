<?php

namespace Botble\Gift\Http\Requests;

use Botble\Gift\Enums\GiftStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class EditGiftRequest extends Request
{
    public function rules(): array
    {
        return [
            'status' => Rule::in(GiftStatusEnum::values()),
        ];
    }
}
