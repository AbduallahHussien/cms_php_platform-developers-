<?php

namespace Botble\Gift\Forms\Settings;

use Botble\Base\Facades\Assets;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\TextField;
use Botble\Gift\Http\Requests\Settings\GiftSettingRequest;
use Botble\Setting\Forms\SettingForm;

class GiftSettingForm extends SettingForm
{
    public function setup(): void
    {
        parent::setup();

        Assets::addStylesDirectly('vendor/core/core/base/libraries/tagify/tagify.css')
            ->addScriptsDirectly([
                'vendor/core/core/base/libraries/tagify/tagify.js',
                'vendor/core/core/base/js/tags.js',
            ]);

        $this
            ->setSectionTitle(trans('plugins/gift::gift.settings.title'))
            ->setSectionDescription(trans('plugins/gift::gift.settings.description'))
            ->setValidatorClass(GiftSettingRequest::class)
            ->add('donor_message', TextField::class, [
                'label' => trans('plugins/gift::gift.settings.donor_message'),
                'value' => setting('donor_message'),
               
            ])
            ->add('recipient_message', TextField::class, [
                'label' => trans('plugins/gift::gift.settings.recipient_message'),
                'value' => setting('recipient_message'),
               
            ])
            ->add('ultra_message_token', TextField::class, [
                'label' => trans('plugins/gift::gift.settings.ultra_message_token'),
                'value' => setting('ultra_message_token'),
               
            ])
            ->add('ultra_message_instance', TextField::class, [
                'label' => trans('plugins/gift::gift.settings.ultra_message_instance'),
                'value' => setting('ultra_message_instance'),
               
            ])
            ->add('ultra_message_app_url', TextField::class, [
                'label' => trans('plugins/gift::gift.settings.ultra_message_app_url'),
                'value' => setting('ultra_message_app_url'),
               
            ])
            ->add('is_enabled', 'html', [
                'html' => view('plugins/gift::partials.enable-disable-gift'),
                'wrapper' => [
                    'class' => 'mb-0',
                ],
            ]);
    }
}
