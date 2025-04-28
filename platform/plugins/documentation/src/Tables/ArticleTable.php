<?php

namespace Botble\Documentation\Tables;

use Botble\Base\Facades\Assets;
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
use Illuminate\Support\Str;


class ArticleTable extends TableAbstract
{
   
    public function setup(): void
    {  
        Assets::addScriptsDirectly('vendor/core/plugins/documentation/js/main.js');
        $this
            ->model(Article::class) 
            ->addActions([
                EditAction::make()->route('documentation.articles.edit'),
                DeleteAction::make()->route('documentation.articles.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                FormattedColumn::make('order')
                ->title(trans('plugins/documentation::article.order'))
                ->getValueUsing(function (FormattedColumn $column) {
                    $article = $column->getItem();
                    $update_order_route = route('documentation.articles.update_order');
                    return '
                    <div class="order-controls" data-id="' . $article->id . '" data-url="' . $update_order_route . '">
                        <button class="btn btn-sm btn-outline-secondary decrease_order">-</button>
                        <span class="order-value mx-2">' . $article->order . '</span>
                        <button class="btn btn-sm btn-outline-secondary increase_order">+</button>
                    </div>';
                }),
                FormattedColumn::make('title')
                               ->title(trans('plugins/documentation::article.title'))
                               ->getValueUsing(function (FormattedColumn $column) {
                    $article = $column->getItem(); 
                    return Str::limit($article->title,10);
                }),
                FormattedColumn::make('content')
                               ->title(trans('plugins/documentation::article.content'))  
                               ->getValueUsing(function (FormattedColumn $column) {
                    $article = $column->getItem(); 
                    return html_entity_decode(Str::limit($article->content,20));
                }),
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
