<?php

return [
    [
        'name' => 'Whatsapp',
        'flag' => 'whatsapp.index',
    ],
    [
        'name'        => 'Create',
        'flag'        => 'whatsapp.create',
        'parent_flag' => 'whatsapp.index',
    ],
    [
        'name'        => 'Edit',
        'flag'        => 'whatsapp.edit',
        'parent_flag' => 'whatsapp.index',
    ],
    [
        'name'        => 'Delete',
        'flag'        => 'whatsapp.destroy',
        'parent_flag' => 'whatsapp.index',
    ],
];
