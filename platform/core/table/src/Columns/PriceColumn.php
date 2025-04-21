<?php

namespace Botble\Table\Columns;

class PriceColumn extends LinkableColumn
{
    public static function make(array|string $data = [], string $price = ''): static
    {
        return parent::make($data ?: 'price', $price)
            ->title(trans('plugins/wesam::wesam.forms.price'))
            ->alignStart();
    }
}
