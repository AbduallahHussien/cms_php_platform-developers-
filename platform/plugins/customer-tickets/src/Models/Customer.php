<?php

namespace Botble\CustomerTickets\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\CustomerTickets\Models\Tickets;

/**
 * @method static \Botble\Base\Models\BaseQueryBuilder<static> query()
 */
class Customer extends BaseModel
{
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'phone_code',
        'phone',
        'email',
        'nationality',
        'gender',
        'status',
        'notes',

    ];
    protected $casts = [
        // 'gender' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'phone_code' => SafeContent::class,
        'phone' => SafeContent::class,
        'email' => SafeContent::class,
        'nationality' => SafeContent::class,
        'notes' => SafeContent::class,
    ];

    public function tickets()
    {
        return $this->hasMany(Tickets::class);
    }
}
