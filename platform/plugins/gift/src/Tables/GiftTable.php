<?php

namespace Botble\Gift\Tables;

use Botble\Gift\Enums\GiftStatusEnum;
use Botble\Gift\Exports\GiftExport;
use Botble\Gift\Models\Gift;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\EmailBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\PhoneBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\EmailColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\PhoneColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Gift\Table\Columns\ProjectName;
use Botble\Gift\Table\Columns\DonorName;
use Botble\Gift\Table\Columns\DonorPhone;
use Botble\Gift\Table\Columns\RecipientName;
use Botble\Gift\Table\Columns\RecipientPhone;
use Botble\Gift\Table\Columns\TemplateName;
use Botble\Table\Columns\YesNoColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class GiftTable extends TableAbstract
{
    protected string $exportClass = GiftExport::class;

    public function setup(): void
    {
        $this
            ->model(Gift::class)
            ->addActions([
                // EditAction::make()->route('gifts.edit'),
                DeleteAction::make()->route('gifts.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                ProjectName::make()->route('gifts.edit'),
                EmailColumn::make(),
                DonorName::make(),
                DonorPhone::make(),
                RecipientName::make(),
                RecipientPhone::make(),
                TemplateName::make(),
                YesNoColumn::make('delivered')
                ->title(trans('Delivered'))
                ->width(100),
                CreatedAtColumn::make(),
                // StatusColumn::make(),
               
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('gifts.destroy'),
            ])
           
            ->queryUsing(function (Builder $query) {
                return $query
                    ->select([
                        'id',
                        'project-name',
                        'email',
                        'donor-name',
                        'donor-phone',
                        'recipient-name',
                        'recipient-phone',
                        'template-name',
                        'delivered',
                        'created_at',
                    ]);
            });
    }

    public function getDefaultButtons(): array
    {
        return [
            'export',
            'reload',
        ];
    }
}
