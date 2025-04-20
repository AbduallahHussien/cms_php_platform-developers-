<?php

namespace Botble\Documentation\Tables;

use Botble\Documentation\Models\Documentation;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\Action;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\Columns\NameColumn;
use Illuminate\Database\Eloquent\Builder;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\Column;

class DocumentationTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Documentation::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('documentation.create'))
            ->addActions([
                Action::make('topics-index')
                        ->route('documentation.topics.index')
                        ->color('success')
                        ->label(trans('plugins/documentation::documentation.topics')),
                Action::make('articles-index')
                        ->route('documentation.articles.index')
                        ->color('success')
                        ->label(trans('plugins/documentation::documentation.articles')),
                EditAction::make()->route('documentation.edit'),
                DeleteAction::make()->route('documentation.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                Column::make('name')->title(trans('plugins/documentation::documentation.title_name')),
                Column::make('link')->title(trans('plugins/documentation::documentation.title_link')),
                // This is important to allow HTML output
                // CreatedAtColumn::make(),
                StatusColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('documentation.destroy'),
            ])
            ->addBulkChanges([
                NameBulkChange::make(),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ])
            ->queryUsing(function (Builder $query) {
                $query->select([
                    'id',
                    'name',
                    'link',
                    // 'created_at',
                    'status',
                ]);
            });
    }
}
