<?php

namespace Botble\PluginUploader;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('Plugin_Uploaders');
        Schema::dropIfExists('Plugin_Uploaders_translations');
    }
}
