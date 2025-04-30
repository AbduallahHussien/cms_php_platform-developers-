<?php

return [
    [
        'name' => 'Gifts',
        'flag' => 'gifts.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'gifts.edit',
        'parent_flag' => 'gifts.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'gifts.destroy',
        'parent_flag' => 'gifts.index',
    ],
    [
        'name' => 'Gift Settings',
        'flag' => 'gift.settings',
        'parent_flag' => 'gifts.index',
    ],
];
