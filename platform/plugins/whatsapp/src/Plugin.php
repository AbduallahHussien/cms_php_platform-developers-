<?php

namespace Botble\Whatsapp;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('whatsapp');
        Schema::dropIfExists('whatsapp_translations');
    }
}
