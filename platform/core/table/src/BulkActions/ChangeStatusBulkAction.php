<?php

namespace Botble\Tables\BulkActions;


use Botble\Base\Contracts\BaseModel;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Table\Abstracts\TableBulkActionAbstract;
use Illuminate\Database\Eloquent\Model;

class ChangeStatusBulkAction extends TableBulkActionAbstract
{
    public function __construct()
    {
        $this
            ->label(__('Change status'))
            ->field('status')
            ->choices(\Botble\Base\Enums\BaseStatusEnum::labels())
            ->confirmationModalButton(__('Save changes'));
    }

    public function dispatch(BaseModel|Model $model, array $ids): BaseHttpResponse
    {
        $status = request()->input('status');

        $model->newQuery()->whereIn('id', $ids)->each(function (Model $item) use ($status) {
            $item->status = $status;
            $item->save();

            UpdatedContentEvent::dispatch($item::class, request(), $item);
        });

        return BaseHttpResponse::make()
            ->setMessage(__('Status updated successfully.'));
    }
}
