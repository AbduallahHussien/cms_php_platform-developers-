<?php

namespace Botble\Gift\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;

class GiftReply extends BaseModel
{
    protected $table = 'gift_replies';

    protected $fillable = [
        'message',
        'gift_id',
    ];

    protected $casts = [
        'message' => SafeContent::class,
    ];
}
