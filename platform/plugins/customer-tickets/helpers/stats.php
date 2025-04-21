<?php

use Botble\CustomerTickets\Models\Tickets;



if (!function_exists('getTicketStats')) {
    function getTicketStats()
    {
        return [
            'total'      => Tickets::count(),
            'open'       => Tickets::where('status', 'open')->count(),
            'inProgress' => Tickets::where('status', 'in_progress')->count(),
            'closed'     => Tickets::where('status', 'closed')->count(),
            'answered'   => Tickets::where('status', 'answered')->count(),
            'pending'    => Tickets::where('status', 'pending')->count(),
        ];
    }
}
