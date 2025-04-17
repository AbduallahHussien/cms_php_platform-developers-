<?php

namespace Botble\Documentation\Providers;

use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Base\Facades\DashboardMenu;
use Botble\Documentation\Models\Documentation;

class DocumentationServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/documentation')
            ->loadHelpers()
            ->loadAndPublishConfigurations(["permissions"])
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadMigrations();
            
            if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Documentation::class, [
                    'name',
                ]);
            }
            
            DashboardMenu::default()->beforeRetrieving(function () {
                DashboardMenu::registerItem([
                    'id' => 'cms-plugins-documentation',
                    'priority' => 5,
                    'parent_id' => null,
                    'name' => 'plugins/documentation::documentation.name',
                    'icon' => 'fa fa-list',
                    'url' => route('documentation.index'),
                    'permissions' => ['documentation.index'],
                ]);
            });
    }
}
