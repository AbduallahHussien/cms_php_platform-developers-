<?php

namespace Botble\PluginUploader\Forms\Settings;

use Botble\PluginUploader\Http\Requests\Settings\PluginUploaderRequest;
use Botble\Setting\Forms\SettingForm;

class PluginUploaderForm extends SettingForm
{
    public function buildForm(): void
    {
        parent::buildForm();

        $this
            ->setSectionTitle('Setting title')
            ->setSectionDescription('Setting description')
            ->setValidatorClass(PluginUploaderRequest::class);
    }
}
