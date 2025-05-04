<?php

namespace Botble\Gift\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;
use Botble\Base\Supports\Avatar;
use Botble\Gift\Enums\GiftStatusEnum;
use Botble\Media\Facades\RvMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Throwable;

class Gift extends BaseModel
{
    protected $table = 'gifts';

    protected $fillable = [
        'project-name',
        'email',
        'donor-name',
        'donor-phone',
        'recipient-name',
        'recipient-phone',
        'template-name',
        'delivered',
    ];

    protected $casts = [
        'project-name' => SafeContent::class,
        'email' => SafeContent::class,
        'donor-name' => SafeContent::class,
        'donor-phone' => SafeContent::class,
        'recipient-name' => SafeContent::class,
        'recipient-phone' => SafeContent::class,
        'template-name' => SafeContent::class,
        'delivered' => SafeContent::class,
    ];



    protected function avatarUrl(): Attribute
    {
        return Attribute::get(function () {
            try {
                return Avatar::createBase64Image($this->name);
            } catch (Throwable) {
                return RvMedia::getDefaultImage();
            }
        });
    }
}
