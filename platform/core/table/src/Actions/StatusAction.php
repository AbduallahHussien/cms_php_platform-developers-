<?php
namespace Botble\Table\Actions;



class StatusAction extends Action
{
    public static function make(string $name = 'status'): static
    {

        return parent::make($name)
        ->label('Change Status')
        ->color('warning')
        ->icon('ti ti-refresh')
        // ->action('UPDATE')

        // ->url(fn ($item) => route('customer.status', $item->id))

        ;
    }


}
