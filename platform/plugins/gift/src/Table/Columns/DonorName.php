<?php

namespace Botble\Gift\Table\Columns;
use Botble\Table\Columns\FormattedColumn;
class DonorName extends FormattedColumn
{
    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data ?: 'donor-name', $name)
            ->title(trans('core/base::tables.donor-name'))
            ->alignStart();
    }
}
