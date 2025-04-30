<?php

namespace Botble\Gift;

use Botble\PluginManagement\Abstracts\PluginOperationAbstract;
use Botble\Setting\Facades\Setting;
use Illuminate\Support\Facades\Schema;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('gifts');
        Schema::dropIfExists('certs');
        Setting::delete([
            'ultra_message_app_url',
            'ultra_message_token',
            'ultra_message_instance',
        ]);
    }
}
