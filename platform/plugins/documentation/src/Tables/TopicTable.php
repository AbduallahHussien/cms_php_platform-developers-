<?php

namespace Botble\Documentation\Tables;

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
                    return $this->renderOrderButtons($topic->order);
                }),
                // StatusColumn::make(),
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

    private function renderOrderButtons(int $order): string
    {
        return "
            <div style='display: flex; align-items: center; gap: 4px;'>
                <button type='button' 
                        onclick='let span = this.nextElementSibling; span.innerText = parseInt(span.innerText || 0) - 1;' 
                        style='border: none; background: none; cursor: pointer;'>▼</button>
                <span class='text-center' 
                      style='width: 60px; display: inline-block;'>{$order}</span>
                <button type='button' 
                        onclick='let span = this.previousElementSibling; span.innerText = parseInt(span.innerText || 0) + 1;' 
                        style='border: none; background: none; cursor: pointer;'>▲</button>
            </div>
        ";
    }
}
