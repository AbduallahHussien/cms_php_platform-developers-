<?php

namespace Botble\CustomerTickets\Http\Controllers;

use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\CustomerTickets\Http\Requests\CustomerRequest;
use Botble\CustomerTickets\Models\Customer;
use Botble\Base\Facades\PageTitle;
use Botble\Base\Http\Controllers\BaseController;
use Botble\CustomerTickets\Tables\CustomerTable;
use Botble\CustomerTickets\Forms\CustomerForm;
use Botble\CustomerTickets\Tables\CustomerTicketsTable;
use Botble\Table\DataTables;
use Botble\Table\TableBuilder;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\Request;
use Botble\Base\Http\Responses\BaseHttpResponse;


class CustomerController extends BaseController
{
    public function __construct()
    {
        $this
            ->breadcrumb()
            ->add(trans(trans('plugins/customer-tickets::customer.name')), route('customer.index'));
    }

    public function index(CustomerTable $table)
    {
        $this->pageTitle(trans('plugins/customer-tickets::customer.name'));

        return $table->renderTable();
    }

    public function updateStatus($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->status = ($customer->status === 'active') ? 'in_active' : 'active';
        $customer->save();

        return back()->with('success', 'Status updated successfully!');
    }


    public function create()
    {
        $this->pageTitle(trans('plugins/customer-tickets::customer.create'));

        return CustomerForm::create()->renderForm();
    }

    public function store(CustomerRequest $request)
    {
        $form = CustomerForm::create()->setRequest($request);

        $form->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('customer.index'))
            ->setNextUrl(route('customer.edit', $form->getModel()->getKey()))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        $this->pageTitle(trans('core/base::forms.view_item', ['name' => $customer->name]));

        return view('plugins.customer-tickets::customer.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $this->pageTitle(trans('core/base::forms.edit_item', ['name' => $customer->name]));

        return CustomerForm::createFromModel($customer)->renderForm();
    }

    public function update(Customer $customer, CustomerRequest $request)
    {
        CustomerForm::createFromModel($customer)
            ->setRequest($request)
            ->save();

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('customer.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(Customer $customer)
    {
        return DeleteResourceAction::make($customer);
    }
}
