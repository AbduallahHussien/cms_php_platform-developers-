<?php

return [
    [
        'name' => 'Plugin uploaders',
        'flag' => 'plugin-uploader.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'plugin-uploader.create',
        'parent_flag' => 'plugin-uploader.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'plugin-uploader.edit',
        'parent_flag' => 'plugin-uploader.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'plugin-uploader.destroy',
        'parent_flag' => 'plugin-uploader.index',
    ],
];
