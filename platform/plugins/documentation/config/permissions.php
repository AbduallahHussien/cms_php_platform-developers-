<?php

return [
    [
        'name' => 'Documentations',
        'flag' => 'documentation.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'documentation.create',
        'parent_flag' => 'documentation.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'documentation.edit',
        'parent_flag' => 'documentation.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'documentation.destroy',
        'parent_flag' => 'documentation.index',
    ],
];
