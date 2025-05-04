<?php

namespace Botble\Gift\Table\Columns;
use Botble\Table\Columns\FormattedColumn;
class TemplateName extends FormattedColumn
{
    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data ?: 'template-name', $name)
            ->title(trans('core/base::tables.template-name'))
            ->alignStart();
    }
}
