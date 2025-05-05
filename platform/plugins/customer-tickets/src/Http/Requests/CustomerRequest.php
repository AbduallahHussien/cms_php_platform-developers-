<?php

namespace Botble\CustomerTickets\Http\Requests;

use Botble\CustomerTickets\Base\Enums\CustomerStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class CustomerRequest extends Request
{
    public function rules(): array
    {
        $customerId = $this->route('customer') ?? $this->route('id'); // Support both 'customer' and 'id'
        return [
            'name'        => ['required', 'string', 'max:220'],
            'phone_code'  => ['required', 'string', 'max:10'],
            'phone'       => ['required', 'string', 'max:20'],
            'email'       => ['nullable', 'email', 'max:255',   Rule::unique('customers', 'email')->ignore($customerId)],
            'nationality' => ['nullable', 'string', 'max:100'],
            'gender'      => ['required', Rule::in(['male', 'female'])],
            'status'      => ['nullable',Rule::in(CustomerStatusEnum::values())],
            'notes'       => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name'        => 'Name',
            'phone_code'  => 'Phone code',
            'phone'       => 'Phone number',
            'email'       => 'Email address',
            'nationality' => 'Nationality',
            'gender'      => 'Gender',
            'status'      => 'Status',
            'notes'       => 'Notes',
        ];
    }
}
