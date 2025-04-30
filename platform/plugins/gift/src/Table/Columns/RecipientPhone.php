<?php

namespace Botble\Gift\Table\Columns;
use Botble\Table\Columns\FormattedColumn;
class RecipientPhone extends FormattedColumn
{
    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data ?: 'recipient-phone', $name)
            ->title(trans('core/base::tables.recipient-phone'))
            ->alignStart();
    }
}
