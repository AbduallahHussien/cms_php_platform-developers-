<?php

namespace Botble\Documentation\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TopicRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:220'],
            'order' => ['required', 'integer', 'min:0'],
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
