<?php

namespace Botble\Documentation\Forms\Settings;

use Botble\Documentation\Http\Requests\Settings\DocumentationRequest;
use Botble\Setting\Forms\SettingForm;

class DocumentationForm extends SettingForm
{
    public function buildForm(): void
    {
        parent::buildForm();

        $this
            ->setSectionTitle('Setting title')
            ->setSectionDescription('Setting description')
            ->setValidatorClass(DocumentationRequest::class);
    }
}
