<?php

namespace Botble\CustomerTickets\Table\Actions;

use Botble\Table\Actions\Action;

class ShowAction extends Action
{
    public static function make(string $name = 'show'): static
    {
        return parent::make($name)
            ->label(__('View'))
            ->color('info')
            ->icon('ti ti-eye');
    }
}
