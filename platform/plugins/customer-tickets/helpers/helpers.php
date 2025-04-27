
<?php

use Botble\CustomerTickets\Models\Tickets;

if (!function_exists('get_country_codes')) {
    function get_country_codes(): array
    {
        return [
            '966' => '+966 (Saudi Arabia)',
            '20'  => '+20 (Egypt)',
            '971' => '+971 (UAE)',
            '965' => '+965 (Kuwait)',
            '962' => '+962 (Jordan)',
            '970' => '+970 (Palestine)',
            '1'   => '+1 (USA)',
            '44'  => '+44 (UK)',
            '49'  => '+49 (Germany)',
            '33'  => '+33 (France)',
            '90'  => '+90 (Turkey)',
        ];
    }
}

if (!function_exists('get_nationalities')) {
    function get_nationalities(): array
    {
        return [
            'Saudi'       => 'Saudi',
            'Egyptian'    => 'Egyptian',
            'Emirati'     => 'Emirati',
            'Kuwaiti'     => 'Kuwaiti',
            'Jordanian'   => 'Jordanian',
            'Palestinian' => 'Palestinian',
            'Syrian'      => 'Syrian',
            'Lebanese'    => 'Lebanese',
            'American'    => 'American',
            'British'     => 'British',
            'German'      => 'German',
            'French'      => 'French',
            'Turkish'     => 'Turkish',
        ];
    }
}

