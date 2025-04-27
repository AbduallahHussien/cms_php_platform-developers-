<?php

namespace Botble\CustomerTickets\Providers;

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\DashboardMenu;

use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;

class CustomerTicketsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {

        $this
            ->setNamespace('plugins/customer-tickets')
            ->loadHelpers()
            ->loadAndPublishConfigurations(["permissions"])
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadMigrations();

            if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(\Botble\CustomerTickets\Models\Customer::class, [
                    'name',
                ]);
            }
            DashboardMenu::default()->beforeRetrieving(function () {
                DashboardMenu::make()
                    ->registerItem([
                        'id' => 'cms-plugins-customer-tickets',
                        'priority' => 120,
                        'name' => 'plugins/customer-tickets::customer-tickets.name',
                        'icon' => 'ti ti-ticket',
                    ])->registerItem([
                        'id' => 'cms-plugins-customer',
                        'priority' => 0,
                        'parent_id' => 'cms-plugins-customer-tickets',
                        'name' => 'plugins/customer-tickets::customer.name',
                        'icon' => null,
                        'url' => route('customer.index'),
                        'permissions' => ['customer.index'],
                    ])->registerItem([
                        'id' => 'cms-plugins-tickets',
                        'priority' => 0,
                        'parent_id' => 'cms-plugins-customer-tickets',
                        'name' => 'plugins/customer-tickets::tickets.name',
                        'icon' => null,
                        'url' => route('tickets.index'),
                        'permissions' => ['tickets.index'],
                    ]);



            });

            $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'plugins.customer-tickets');


            if (defined('ADMIN_MODULE_SCREEN_NAME')) {
                Assets::addScriptsDirectly([
                    'vendor/core/plugins/customer-tickets/js/customer-status.js',
                ]);
            }
    }
}
