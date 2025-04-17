<?php

namespace Botble\Documentation\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class DocumentationRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:220'],
            'link' => ['required'],
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
