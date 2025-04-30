<?php

namespace Botble\Gift\Forms;

use Botble\Base\Forms\FieldOptions\MultiChecklistFieldOption;
use Botble\Base\Forms\Fields\MultiCheckListField;
use Botble\Shortcode\Forms\ShortcodeForm;

class ShortcodeGiftAdminConfigForm extends ShortcodeForm
{
    public function setup(): void
    {
        parent::setup();

        $fields = [
            'phone' => trans('plugins/gift::gift.sender_phone'),
            'email' => trans('plugins/gift::gift.form_email'),
            'subject' => trans('plugins/gift::gift.form_subject'),
            'address' => trans('plugins/gift::gift.form_address'),
        ];

        $this
            ->add(
                'display_fields',
                MultiCheckListField::class,
                MultiChecklistFieldOption::make()
                    ->label(trans('plugins/gift::gift.display_fields'))
                    ->choices($fields)
                    ->defaultValue(array_keys($fields))
                    ->toArray()
            )
            ->add(
                'mandatory_fields',
                MultiCheckListField::class,
                MultiChecklistFieldOption::make()
                    ->label(trans('plugins/gift::gift.mandatory_fields'))
                    ->helperText(trans('plugins/gift::gift.mandatory_fields_helper_text'))
                    ->choices($fields)
                    ->defaultValue(['email'])
                    ->toArray()
            );
    }
}
