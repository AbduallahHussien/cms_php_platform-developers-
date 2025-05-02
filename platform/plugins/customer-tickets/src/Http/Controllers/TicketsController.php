<?php

namespace Botble\CustomerTickets\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\CustomerTickets\Http\Requests\TicketsRequest;
use Botble\CustomerTickets\Models\Tickets;
use Botble\Base\Http\Controllers\BaseController;
use Botble\CustomerTickets\Tables\TicketsTable;
use Botble\CustomerTickets\Forms\TicketsForm;
use Botble\CustomerTickets\Models\Customer;


class TicketsController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans(trans('plugins/customer-tickets::tickets.name')), route('tickets.index'));
    }

    public function index(TicketsTable $table)
    {
        $this->pageTitle(trans('plugins/customer-tickets::tickets.name'));

        $stats = getTicketStats();

        return $table->render('plugins/customer-tickets::tickets.index', $stats);
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/customer-tickets::tickets.create'));

        return TicketsForm::create()->renderForm();
    }

    public function store(TicketsRequest $request)
    {
        $userId = auth()->id();

        $form = TicketsForm::create()->setRequest($request);

        $form->getModel()->user_id = $userId;

        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('tickets.index'))
            ->setNextUrl(route('tickets.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }
    public function show($id)
    {
        $ticket = Tickets::findOrFail($id);

        $this->pageTitle(trans('core/base::forms.view_item', ['name' => $ticket->customer->name])  . 'Ticket');

        return view('plugins.customer-tickets::tickets.show', compact('ticket'));
    }

    public function edit(Tickets $ticket)
    {
        $customers = Customer::pluck('name', 'id')->toArray();
        $ticket->load('comments');
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $ticket->customer->name]) . 'Ticket');
        return view('plugins.customer-tickets::tickets.edit', compact('customers', 'ticket'));
    }

    public function update(Tickets $tickets, TicketsRequest $request)
    {
        TicketsForm::createFromModel($tickets)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('tickets.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Tickets $tickets)
    {
        return DeleteResourceAction::make($tickets);
    }
    
}
