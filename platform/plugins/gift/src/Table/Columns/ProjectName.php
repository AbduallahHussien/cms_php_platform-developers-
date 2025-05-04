<?php

namespace Botble\Gift\Table\Columns;
use Botble\Table\Columns\LinkableColumn;
class ProjectName extends LinkableColumn
{
    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data ?: 'project-name', $name)
            ->title(trans('core/base::tables.project-name'))
            ->alignStart();
    }
}
