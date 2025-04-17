<?php

namespace Botble\Documentation\Http\Controllers\Settings;

use Botble\Base\Forms\FormBuilder;
use Botble\Documentation\Forms\Settings\DocumentationForm;
use Botble\Documentation\Http\Requests\Settings\DocumentationRequest;
use Botble\Setting\Http\Controllers\SettingController;

class DocumentationController extends SettingController
{
    public function edit(FormBuilder $formBuilder)
    {
        $this->pageTitle('Page title');

        return $formBuilder->create(DocumentationForm::class)->renderForm();
    }

    public function update(DocumentationRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}
