<?php

return [
    [
        'name' => 'Plugin  uploaders',
        'flag' => 'plugin_uploader.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'plugin_uploader.create',
        'parent_flag' => 'plugin_uploader.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'plugin_uploader.edit',
        'parent_flag' => 'plugin_uploader.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'plugin_uploader.destroy',
        'parent_flag' => 'plugin_uploader.index',
    ],
];
