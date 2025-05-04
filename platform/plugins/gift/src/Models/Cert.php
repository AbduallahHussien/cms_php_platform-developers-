<?php

namespace Botble\Gift\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\Avatar;
use Botble\Gift\Enums\GiftStatusEnum;
use Botble\Media\Facades\RvMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Botble\Base\Enums\BaseStatusEnum;
use Throwable;

class Cert extends BaseModel
{
    protected $table = 'certs';

    protected $fillable = [
        'name',
        'font_color',
        'font_size',
        'from_x', 
        'from_y', 
        'to_x',   
        'to_y', 
        'image',
        'status',
    ];

    protected $casts = [
       'status' => BaseStatusEnum::class,
    ];

}
