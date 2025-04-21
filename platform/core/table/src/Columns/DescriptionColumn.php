<?php

namespace Botble\Table\Columns;

class DescriptionColumn extends LinkableColumn
{
    public static function make(array|string $data = [], string $description = ''): static
    {
        return parent::make($data ?: 'description', $description)
            ->title(trans('plugins/wesam::wesam.forms.description'))
            ->alignStart();
    }
}
