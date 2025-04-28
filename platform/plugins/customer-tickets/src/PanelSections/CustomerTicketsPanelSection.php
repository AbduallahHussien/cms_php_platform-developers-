<?php

namespace Botble\CustomerTickets\PanelSections;

use Botble\Base\PanelSections\PanelSection;

class CustomerTicketsPanelSection extends PanelSection
{
    public function setup(): void
    {
        $this
            ->setId('settings.{id}')
            ->setTitle('{title}')
            ->withItems([
                //
            ]);
    }
}
