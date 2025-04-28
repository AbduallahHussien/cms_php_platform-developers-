<?php

namespace Botble\PluginUploader\Providers;

use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;

class PluginUploaderServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/plugin_uploader')
            ->loadHelpers()
            ->loadAndPublishConfigurations(["permissions"])
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadMigrations();
            
            $this->app->booted(function () 
            { 
                $this->app->register(HookServiceProvider::class);
            });
            
    }
}
