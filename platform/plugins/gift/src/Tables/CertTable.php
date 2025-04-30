<?php

namespace Botble\Gift\Tables;

use Botble\Gift\Enums\GiftStatusEnum;
use Botble\Gift\Exports\GiftExport;
use Botble\Gift\Models\Cert;
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
use Botble\Gift\Table\Columns\CustomNameColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Gift\Table\Columns\PhoneColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Gift\Table\Columns\ProjectName;
use Botble\Gift\Table\Columns\DonorName;
use Botble\Gift\Table\Columns\DonorPhone;
use Botble\Gift\Table\Columns\RecipientName;
use Botble\Gift\Table\Columns\RecipientPhone;
use Botble\Gift\Table\Columns\TemplateName;
use Botble\Table\Columns\ImageColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;

class CertTable extends TableAbstract
{
    // protected string $exportClass = GiftExport::class;

    public function setup(): void
    {
        $this
            ->model(Cert::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('certs.create'))
            ->addActions([
                
                EditAction::make()->route('certs.edit'),
                DeleteAction::make()->route('certs.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),
                ImageColumn::make(),
                CustomNameColumn::make(),
                StatusColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('certs.destroy'),
            ])
           
            ->queryUsing(function (Builder $query) {
                return $query
                    ->select([
                        'id',
                        'image',
                        'name',
                        'status',
                        
                    ]);
            });
    }

    public function getDefaultButtons(): array
    {
        return [
            // 'export',
            'reload',
        ];
    }
}
