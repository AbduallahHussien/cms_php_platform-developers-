<?php

namespace Botble\Documentation;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('Documentations');
        Schema::dropIfExists('Documentations_translations');
    }
}
