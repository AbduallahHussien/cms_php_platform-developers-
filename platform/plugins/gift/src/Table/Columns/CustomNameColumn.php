<?php

namespace Botble\Gift\Table\Columns;
use Botble\Table\Columns\FormattedColumn;
class CustomNameColumn extends FormattedColumn
{
    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data ?: 'name', $name)
            ->title(trans('core/base::tables.name'))
            ->alignStart();
    }
}
