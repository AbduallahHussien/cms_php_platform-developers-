<?php

namespace Botble\CustomerTickets\Models;

use App\Models\User;
use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Botble\CustomerTickets\Models\Tickets;

/**
 * @method static \Botble\Base\Models\BaseQueryBuilder<static> query()
 */
class Comment extends BaseModel
{
    protected $table = 'comments';

    protected $fillable = [
      'user_id',
      'ticket_id',
      'text'
    ];
        public function ticket()
    {
        return $this->belongsTo(Tickets::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
