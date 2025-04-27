<?php

namespace Botble\CustomerTickets;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('customers');

    }
}
