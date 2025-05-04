<?php

namespace Botble\Gift\Repositories\Eloquent;

use Botble\Gift\Enums\GiftStatusEnum;
use Botble\Gift\Repositories\Interfaces\GiftInterface;
use Botble\Support\Repositories\Eloquent\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Collection;

class GiftRepository extends RepositoriesAbstract implements GiftInterface
{
    public function getUnread(array $select = ['*']): Collection
    {
        $data = $this->model
            ->where('status', GiftStatusEnum::UNREAD)
            ->select($select)
            ->orderByDesc('created_at')
            ->get();

        $this->resetModel();

        return $data;
    }

    public function countUnread(): int
    {
        $data = $this->model->where('status', GiftStatusEnum::UNREAD)->count();
        $this->resetModel();

        return $data;
    }
}
