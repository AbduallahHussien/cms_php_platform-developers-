<?php

namespace Botble\Documentation\Tables;

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\Html;
use Botble\Contact\Enums\ContactStatusEnum;
use Botble\Documentation\Models\Topic;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\EditAction;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\Columns\FormattedColumn;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\BulkChanges\CreatedAtBulkChange;

class TopicTable extends TableAbstract
{
    public function setup(): void
    {
        Assets::addScriptsDirectly('vendor/core/plugins/documentation/js/main.js');
        $this
            ->model(Topic::class)
            ->addActions([
                EditAction::make()->route('documentation.topics.edit'),
                DeleteAction::make()->route('documentation.topics.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                Column::make('name')->title(trans('plugins/documentation::documentation.title_name')),
                FormattedColumn::make('order')
                    ->title(trans('plugins/documentation::topic.order'))
                    ->getValueUsing(function (FormattedColumn $column) {
                        $topic = $column->getItem();
                        $update_order_route = route('documentation.topics.update_order');
                        return '
                        <div class="order-controls" data-id="' . $topic->id . '" data-url="' . $update_order_route . '">
                            <button class="btn btn-sm btn-outline-secondary decrease_order">-</button>
                            <span class="order-value mx-2">' . $topic->order . '</span>
                            <button class="btn btn-sm btn-outline-secondary increase_order">+</button>
                        </div>';
                    }),
                StatusColumn::make(), 
                // FormattedColumn::make('status')
                //                ->title('Status')
                //                ->renderUsing(function (FormattedColumn $column) {
                //     $topic = $column->getItem(); 
                //         return "<input type='number'
                //         class='form-control topic-order-input'
                //         data-id='{$topic->id}'
                //         value='{$topic->order}'
                //         min='0'
                //         step='1'
                //         style='width: 80px;' />";
                // })
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('documentation.topics.destroy'),
            ])
            ->addBulkChanges([
                NameBulkChange::make(),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ]);
    }

    // private function renderOrderButtons(int $order, int $id = null): string
    // {
    //     return "<input type='number'
    //              class='form-control topic-order-input'
    //              data-id='{$id}'
    //              value='{$order}'
    //              min='0'
    //              step='1'
    //              style='width: 80px;' />";
    // }
}
