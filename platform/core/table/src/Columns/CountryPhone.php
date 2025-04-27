<?php

namespace Botble\Table\Columns;

class CountryPhone extends Column
{
    public static function make(array|string $data = [], string $label = ''): static
    {
        return parent::make('phone_code', $label ?: __('Phone'))
            ->displayUsing(function ($record) {
                $code = is_array($record) ? $record['phone_code'] : $record->phone_code;
                $phone = is_array($record) ? $record['phone'] : $record->phone;

                return $code . ' ' . $phone;
            })
            ->title(__('Phone'))
            ->alignStart();
    }


}
