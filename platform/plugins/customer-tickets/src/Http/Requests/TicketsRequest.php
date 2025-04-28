<?php

namespace Botble\CustomerTickets\Http\Requests;

use Botble\Base\Enums\TicketLevelEnum;
use Botble\Base\Enums\TicketStatusEnum;
use Botble\Base\Enums\TicketTypeEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class TicketsRequest extends Request
{
    public function rules(): array
    {
        return [
            // 'user_id'     => ['required', 'exists:users,id'],
            'customer_id' => ['required', 'exists:customers,id'],
            'type'        => ['required', Rule::in(TicketTypeEnum::values())],
            'level'       => ['nullable', Rule::in(TicketLevelEnum::values())],
            'description' => ['nullable', 'string'],
            'status'      => ['nullable', Rule::in(TicketStatusEnum::values())],
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id'     => 'User',
            'customer_id' => 'Customer',
            'type'        => 'Ticket Type',
            'level'       => 'Priority Level',
            'description' => 'Description',
            'status'      => 'Status',
        ];
    }
}
