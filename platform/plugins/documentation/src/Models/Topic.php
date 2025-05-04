<?php

namespace Botble\Documentation\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static \Botble\Base\Models\BaseQueryBuilder<static> query()
 */
class Topic extends BaseModel
{
    protected $table = 'topics';

    protected $fillable = [
        'documentation_id',
        'order',
        'name',
        'status'
    ];

    protected $casts = [ 
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
    ];

    public function documentation(): BelongsTo
    {
        return $this->belongsTo(Documentation::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
     
}
