<?php

namespace Botble\Gift\Table\Columns;
use Botble\Table\Columns\FormattedColumn;
class RecipientName extends FormattedColumn
{
    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data ?: 'recipient-name', $name)
            ->title(trans('core/base::tables.recipient-name'))
            ->alignStart();
    }
}
