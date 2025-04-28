<?php

namespace Botble\Table\BulkChanges;

class PriceBulkChange extends TextBulkChange
{
    public static function make(array $data = []): static
    {
        return parent::make()
            ->name('price')
            ->title(trans('plugins/wesam::wesam.forms.price'));
    }
}
