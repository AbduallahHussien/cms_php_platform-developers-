<?php

namespace Botble\CustomerTickets\Tables;

use Botble\CustomerTickets\Models\Tickets;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\Column;
use Botble\Table\DataTables;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Database\Eloquent\Builder;

class CustomerTicketsTable extends TableAbstract
{
    protected int $customerId;

    public function __construct(DataTables $dataTables, UrlGenerator $urlGenerator, int $customerId)
    {
        parent::__construct($dataTables, $urlGenerator);

        $this->customerId = $customerId;
    }
    public function setup(): void
    {
        $this
            ->model(Tickets::class)

            ->addColumns([
                IdColumn::make(),

                Column::make('type')->title(__('Type')),

                Column::make('level')->title(__('Level')),

                Column::make('status')->title(__('Status')),

                CreatedAtColumn::make(),
            ])
            ->queryUsing(function (Builder $query) {
                $query->select([
                        'tickets.id',
                        'tickets.type',
                        'tickets.level',
                        'tickets.status',
                        'tickets.created_at',
                    ])
                    ->where('tickets.customer_id', $this->customerId);
            });
    }
}
