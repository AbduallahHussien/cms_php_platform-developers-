<?php

namespace Botble\Documentation\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;

/**
 * @method static \Botble\Base\Models\BaseQueryBuilder<static> query()
 */
class Article extends BaseModel
{
    protected $table = 'articles';

    protected $fillable = [
        'title',
        'content',
        'documentation_id',
        'topic_id',
        'user_id',
    ];

    protected $casts = [ 
        'status' => BaseStatusEnum::class,
        'title' => SafeContent::class,
    ];

    

     
}
