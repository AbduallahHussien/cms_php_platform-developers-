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
    [
        'name'        => 'Contacts',
        'flag'        => 'contacts.index',
        'parent_flag' => 'whatsapp.index',
    ],
    [
        'name'        => 'Settings',
        'flag'        => 'whatsapp.settings',
        'parent_flag' => 'whatsapp.index',
    ],
    [
        'name'        => 'Send To Group',
        'flag'        => 'whatsapp.send_to_group',
        'parent_flag' => 'whatsapp.index',
    ],
    [
        'name'        => 'New Chat',
        'flag'        => 'whatsapp.new_chat',
        'parent_flag' => 'whatsapp.index',
    ],
    [
        'name'        => 'Templates',
        'flag'        => 'whatsapp.templates',
        'parent_flag' => 'whatsapp.index',
    ],
    [
        'name'        => 'Groups',
        'flag'        => 'whatsapp.groups',
        'parent_flag' => 'whatsapp.index',
    ],
    [
        'name'        => 'Reports',
        'flag'        => 'whatsapp.reports',
        'parent_flag' => 'whatsapp.index',
    ],
];
