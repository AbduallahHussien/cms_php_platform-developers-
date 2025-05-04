<?php

namespace Botble\Gift\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Rules\MediaImageRule;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CertRequest extends Request
{
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:250'],
            'font_size' => ['required', 'string', 'max:250'],
            'from_x' => ['required'],
            'from_y' => ['required'],
            'to_x' => ['required'],
            'to_y' => ['required'],
            'font_color' => ['required', 'string', 'max:250'],
            'status' => Rule::in(BaseStatusEnum::values()),
            'image' => ['nullable', 'string', new MediaImageRule()],
        ];


        return $rules;
    }
}
