<?php

namespace Botble\Documentation\Tables;

use Botble\Documentation\Models\Article;
use Botble\Documentation\Models\Documentation;
use Botble\Documentation\Models\Topic;
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
use Botble\Table\Columns\FormattedColumn;

class ArticleTable extends TableAbstract
{
   
    public function setup(): void
    {  
        $this
            ->model(Article::class) 
            ->addActions([
                EditAction::make()->route('documentation.articles.edit'),
                DeleteAction::make()->route('documentation.articles.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                Column::make('title')->title(trans('plugins/documentation::article.title')),
                Column::make('content')->title(trans('plugins/documentation::article.content')),
                FormattedColumn::make('topic_id')
                               ->title(trans('plugins/documentation::article.topic'))
                               ->getValueUsing(function (FormattedColumn $column) {
                                $article = $column->getItem(); 
                                return $article->topic?->name;
                }),
                CreatedAtColumn::make(),
                FormattedColumn::make('user_id')
                      ->title(trans('plugins/documentation::article.author'))
                      ->getValueUsing(function (FormattedColumn $column) {
                            $article = $column->getItem(); 
                            return $article->author?->first_name;
                }),
                StatusColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('documentation.articles.destroy'),
            ])
            ->addBulkChanges([
                NameBulkChange::make(),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ]);
            
    }
}
