<?php

namespace Botble\Documentation\Tables;

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
                StatusColumn::make(),
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
}
