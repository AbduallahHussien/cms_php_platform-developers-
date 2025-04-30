<?php

namespace Botble\PluginUploader\Providers;

use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Base\Facades\DashboardMenu;
use Botble\PluginUploader\Models\PluginUploader;

class PluginUploaderServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/plugin-uploader')
            ->loadHelpers()
            ->loadAndPublishConfigurations(["permissions"])
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadMigrations();
            
            if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(PluginUploader::class, [
                    'name',
                ]);
            }
            
            DashboardMenu::default()->beforeRetrieving(function () {
                DashboardMenu::registerItem([
                    'id' => 'cms-plugins-plugin uploader',
                    'priority' => 5,
                    'parent_id' => 'cms-core-plugins',
                    'name' => 'Plugin Uploader',
                    'icon' => 'fa fa-upload',
                    'url' => route('plugin-uploader.index'),
                    'permissions' => ['plugin uploader.index'],
                ]);
            });
    }
}
