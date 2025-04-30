<?php

namespace Botble\Gift\Http\Controllers\Settings;

use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\Gift\Forms\Settings\GiftSettingForm;
use Botble\Gift\Http\Requests\Settings\GiftSettingRequest;
use Botble\Setting\Http\Controllers\SettingController;
use Illuminate\Support\Arr;

class GiftSettingController extends SettingController
{
    public function edit()
    {
        $this->pageTitle(trans('plugins/gift::gift.settings.title'));

        return GiftSettingForm::create()->renderForm();
    }

    public function update(GiftSettingRequest $request)
    {
        $this->saveSettings([
                            'donor_message' => $request->donor_message,
                            'recipient_message' => $request->recipient_message,
                            'ultra_message_token' => $request->ultra_message_token,
                            'ultra_message_instance' => $request->ultra_message_instance,
                            'ultra_message_app_url' => $request->ultra_message_app_url,
                        ]);
        return $this->httpResponse()->withUpdatedSuccessMessage();
    }
}
