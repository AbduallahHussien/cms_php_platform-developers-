<?php

namespace Botble\Gift\Table\Columns;
use Botble\Table\Columns\FormattedColumn;
class DonorPhone extends FormattedColumn
{
    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data ?: 'donor-phone', $name)
            ->title(trans('core/base::tables.donor-phone'))
            ->alignStart();
    }
}
