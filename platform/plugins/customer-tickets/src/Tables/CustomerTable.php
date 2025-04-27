<?php

namespace Botble\CustomerTickets\Tables;

use Botble\CustomerTickets\Models\Customer;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\ShowAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\CountryPhone;
use Illuminate\Database\Eloquent\Builder;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\Columns\Column;
use Illuminate\Support\Facades\DB;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Enums\CustomerStatusEnum;
use Botble\Base\Facades\Html;
use Botble\Table\Actions\StatusAction;
use Botble\Table\Columns\PhoneWithCodeColumn;
use Botble\Tables\BulkActions\ChangeStatusBulkAction;

class CustomerTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(Customer::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('customer.create'))
            ->addActions([
                ShowAction::make()->route('customer.show'),
                EditAction::make()->route('customer.edit'),
                DeleteAction::make()->route('customer.destroy'),
                StatusAction::make()->route('customer.status')


            ])

            ->addColumns([

                    IdColumn::make(),

                    NameColumn::make(),

                    Column::make('phone_code')
                    ->title(__('Phone Code')),

                    Column::make('phone')
                    ->title(__('Phone')),

                    // PhoneWithCodeColumn::make()->withEmptyState(),

                    //  Column::make('phone')->value(function ($row) {
                    //      return $row->phone_code . ' - ' . $row->phone;
                    //  }),

                    // ->displayUsing(function ($item) {
                    //     return $item->phone_code . ' ' . $item->phone;
                    // })


                    Column::make('email')
                        ->title(__('Email')),

                    Column::make('nationality')
                        ->title(__('Nationality')),

                    Column::make('gender')
                        ->title(__('Gender')),

                        Column::make('status')
                        ->title(__('Status')),


                    CreatedAtColumn::make(),
                ])


            ->addBulkActions([
                DeleteBulkAction::make()->permission('customer.destroy'),

                // ChangeStatusBulkAction::make()->permission('customer.edit'),
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
                    'phone_code',
                    'phone',
                    'email',
                    'nationality',
                    'gender',
                    'status',
                    'created_at',
                ]);
            });
    }
}
