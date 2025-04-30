<?php

namespace Botble\Gift\Repositories\Interfaces;

use Botble\Support\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

interface GiftInterface extends RepositoryInterface
{
    public function getUnread(array $select = ['*']): Collection;

    public function countUnread(): int;
}
