<?php

namespace Botble\Documentation\Models;

use App\Models\User;
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
        'order',
        'title',
        'content',
        'documentation_id',
        'topic_id',
        'user_id',
        'status'
    ];

    protected $casts = [ 
        'status' => BaseStatusEnum::class,
        'title'  => SafeContent::class,
        'content' => SafeContent::class,
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function documentation()
    {
        return $this->belongsTo(Documentation::class,'documentation_id','id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class,'topic_id','id');
    }

    

     
}
