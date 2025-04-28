<?php

namespace Botble\Documentation\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class ArticleRequest extends Request
{
    public function rules(): array
    {
        return [
            'order' => 'required|integer|min:0',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'documentation_id' => 'required|exists:documentations,id',
            'topic_id' => 'required|exists:topics,id',
            'user_id' => 'required|exists:users,id',
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}
