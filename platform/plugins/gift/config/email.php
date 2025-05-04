<?php

return [
    'name' => 'plugins/gift::gift.settings.email.title',
    'description' => 'plugins/gift::gift.settings.email.description',
    'templates' => [
        'notice' => [
            'title' => 'plugins/gift::gift.settings.email.templates.notice_title',
            'description' => 'plugins/gift::gift.settings.email.templates.notice_description',
            'subject' => 'Message sent via your gift form from {{ site_title }}',
            'can_off' => true,
            'variables' => [
                'gift_name' => 'Gift name',
                'gift_subject' => 'Gift subject',
                'gift_email' => 'Gift email',
                'gift_phone' => 'Gift phone',
                'gift_address' => 'Gift address',
                'gift_content' => 'Gift content',
            ],
        ],
    ],
];
