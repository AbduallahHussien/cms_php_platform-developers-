<?php

namespace Botble\PluginUploader\Http\Controllers\Settings;

use Botble\Base\Forms\FormBuilder;
use Botble\PluginUploader\Forms\Settings\PluginUploaderForm;
use Botble\PluginUploader\Http\Requests\Settings\PluginUploaderRequest;
use Botble\Setting\Http\Controllers\SettingController;

class PluginUploaderController extends SettingController
{
    public function edit(FormBuilder $formBuilder)
    {
        $this->pageTitle('Page title');

        return $formBuilder->create(PluginUploaderForm::class)->renderForm();
    }

    public function update(PluginUploaderRequest $request)
    {
        return $this->performUpdate($request->validated());
    }
}
