<?php

return [


    [
        'name' => 'Delete',
        'flag' => 'customer-tickets.destroy',
        'parent_flag' => 'customer-tickets.index',
    ],
    [
        'name' => 'Customers',
        'flag' => 'customer.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'customer.create',
        'parent_flag' => 'customer.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'customer.edit',
        'parent_flag' => 'customer.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'customer.destroy',
        'parent_flag' => 'customer.index',
    ],

    [
        'name' => 'Tickets',
        'flag' => 'tickets.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'tickets.create',
        'parent_flag' => 'tickets.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'tickets.edit',
        'parent_flag' => 'tickets.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'tickets.destroy',
        'parent_flag' => 'tickets.index',
    ],

];
