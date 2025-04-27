<?php


namespace Botble\CustomerTickets\Tables;

use Botble\CustomerTickets\Models\Tickets;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\Column;
use Illuminate\Database\Eloquent\Builder;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;


class TicketsTable extends TableAbstract
{

    public function setup(): void
    {


        $this
            ->model(Tickets::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('tickets.create'))
            ->addActions([
                EditAction::make()->route('tickets.edit'),
                DeleteAction::make()->route('tickets.destroy'),
            ])
            ->addColumns([
                IdColumn::make(),

                Column::make('user_name')->title(__('User Name')),

                Column::make('customer_name')->title(__('Customer Name')),

                Column::make('type')->title(__('Type')),

                Column::make('level')->title(__('Level')),

                Column::make('status')->title(__('Status')),

                CreatedAtColumn::make(),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('tickets.destroy'),
            ])

            ->addBulkChanges([
                NameBulkChange::make(),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ])
            ->queryUsing(function (Builder $query) {
                $query->select([
                    'tickets.id',
                    'tickets.type',
                    'tickets.level',
                    'tickets.status',
                    'tickets.created_at',
                    'users.username as user_name',
                    'customers.name as customer_name',
                ])
                ->leftJoin('users', 'users.id', '=', 'tickets.user_id')
                ->leftJoin('customers', 'customers.id', '=', 'tickets.customer_id');
            });
    }


// public function renderTable(array $data = [], array $mergeData = []): View|Factory|Response
// {
//     // الاحصائيات
//     $stats = [
//         'total' => Tickets::count(),
//         'open' => Tickets::where('status', 'open')->count(),
//         'inProgress' => Tickets::where('status', 'in_progress')->count(),
//         'closed' => Tickets::where('status', 'closed')->count(),
//     ];

//     // HTML الإحصائيات
//     $statsHtml = '
//         <div class="row mb-4">
//             <div class="col-md-3">
//                 <div class="card text-white bg-primary mb-3">
//                     <div class="card-body">
//                         <h5 class="card-title">Total Tickets</h5>
//                         <p class="card-text">' . $stats['total'] . '</p>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-md-3">
//                 <div class="card text-white bg-success mb-3">
//                     <div class="card-body">
//                         <h5 class="card-title">Open</h5>
//                         <p class="card-text">' . $stats['open'] . '</p>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-md-3">
//                 <div class="card text-white bg-warning mb-3">
//                     <div class="card-body">
//                         <h5 class="card-title">In Progress</h5>
//                         <p class="card-text">' . $stats['inProgress'] . '</p>
//                     </div>
//                 </div>
//             </div>
//             <div class="col-md-3">
//                 <div class="card text-white bg-danger mb-3">
//                     <div class="card-body">
//                         <h5 class="card-title">Closed</h5>
//                         <p class="card-text">' . $stats['closed'] . '</p>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     ';

//     // دمج الإحصائيات مع الجدول
//     $tableView = parent::renderTable($data, $mergeData);

//     return response($statsHtml . $tableView->render());
// }

}
