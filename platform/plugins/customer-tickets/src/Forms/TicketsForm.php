<?php

namespace Botble\CustomerTickets\Forms;

use Botble\Base\Enums\CustomerStatusEnum;
use Botble\Base\Forms\FormAbstract;
use Botble\CustomerTickets\Models\Tickets;
use Botble\CustomerTickets\Http\Requests\TicketsRequest;
use Botble\CustomerTickets\Base\Enums\TicketTypeEnum;
use Botble\CustomerTickets\Base\Enums\TicketLevelEnum;
use Botble\CustomerTickets\Models\Customer;

class TicketsForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->setupModel(new Tickets())
            ->setValidatorClass(TicketsRequest::class)
            ->withCustomFields()

            ->add('customer_id', 'select', [
                'label' => trans('plugins/customer-tickets::tickets.customer'),
                'required' => true,
                'choices' => $this->getCustomerChoices(),
            ])
            ->add('type', 'select', [
                'label' => trans('plugins/customer-tickets::tickets.ticket_type'),
                'required' => true,
                'choices' => TicketTypeEnum::labels(),
            ])
            ->add('level', 'select', [
                'label' => trans('plugins/customer-tickets::tickets.ticket_level'),
                'required' => true,
                'choices' => TicketLevelEnum::labels(),
            ])
            ->add('description', 'textarea', [
                'label' => trans('plugins/customer-tickets::tickets.description'),
                'required' => true,
                'attr' => [
                    'placeholder' => trans('plugins/customer-tickets::tickets.description_placeholder'),
                    'rows' => 5,
                ],
            ]);
    }

    protected function getCustomerChoices()
    {
        return Customer::where('status',CustomerStatusEnum::ACTIVE)->pluck('name', 'id')->toArray();
        // return \Botble\CustomerTickets\Models\Customer::whereDoesntHave('tickets')
        // ->pluck('name', 'id')
        // ->toArray();
    }
}
