<?php

namespace Botble\CustomerTickets\Models;

use App\Models\User;
use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static \Botble\Base\Models\BaseQueryBuilder<static> query()
 */
class Tickets extends BaseModel
{
    protected $table = 'tickets';

    protected $fillable = [
        'user_id',
        'customer_id',
        'type',
        'level',
        'description',
        'status',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'ticket_id');
    }
}
