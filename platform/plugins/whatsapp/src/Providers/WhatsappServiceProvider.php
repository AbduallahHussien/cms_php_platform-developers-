<?php

namespace Botble\Whatsapp\Providers;

use Botble\Whatsapp\Models\Whatsapp;
use Illuminate\Support\ServiceProvider;
use Botble\Whatsapp\Repositories\Caches\WhatsappCacheDecorator;
use Botble\Whatsapp\Repositories\Eloquent\WhatsappRepository;
use Botble\Whatsapp\Repositories\Interfaces\WhatsappInterface;
use Illuminate\Support\Facades\Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class WhatsappServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(WhatsappInterface::class, function () {
            return new WhatsappCacheDecorator(new WhatsappRepository(new Whatsapp));
        });

        $this->setNamespace('plugins/whatsapp')->loadHelpers();
    }

    public function boot()
    {
        $this
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
                // Use language v2
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Whatsapp::class, [
                    'name',
                ]);
            } else {
                // Use language v1
                $this->app->booted(function () {
                    \Language::registerModule([Whatsapp::class]);
                });
            }
        }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-whatsapp',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/whatsapp::whatsapp.name',
                'icon'        => 'fa fa-list',
                'url'         => route('whatsapp.index'),
                'permissions' => ['whatsapp.index'],
            ]);
        });
    }
}
