<?php

namespace Botble\Whatsapp\Providers;

use Botble\Whatsapp\Models\Whatsapp;
use Illuminate\Support\ServiceProvider;
use Botble\Whatsapp\Repositories\Caches\WhatsappCacheDecorator;
use Botble\Whatsapp\Repositories\Eloquent\WhatsappRepository;
use Botble\Whatsapp\Repositories\Interfaces\WhatsappInterface;
use Illuminate\Support\Facades\Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Language\Facades\Language;
use Botble\LanguageAdvanced\Supports\LanguageAdvancedManager;
use Illuminate\Routing\Events\RouteMatched;
use Botble\Whatsapp\Providers\EventServiceProvider;
class WhatsappServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    
    public function register()
    {
        $this->app->register(EventServiceProvider::class);

        $this->app->bind(WhatsappInterface::class, function () {
            return new WhatsappCacheDecorator(new WhatsappRepository(new Whatsapp));
        });

        $this->setNamespace('plugins/whatsapp')->loadHelpers();

        // ✅ Load your plugin’s firebase config
        $this->mergeConfigFrom(__DIR__ . '/../../config/firebase.php', 'whatsapp-firebase');

        // ✅ Bind Kreait using this plugin’s config
        $this->app->singleton('whatsapp.firebase.database', function ($app) {
            $factory = (new \Kreait\Firebase\Factory)
                ->withServiceAccount(config('whatsapp-firebase.credentials.file'))
                ->withDatabaseUri(config('whatsapp-firebase.database.url'));

            return $factory->createDatabase();
        });
    }

    public function boot()
    {
        $this
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web','api']);

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
                // Use language v2
                LanguageAdvancedManager::registerModule(Whatsapp::class, ['name',]);
            } else {
                // Use language v1
                $this->app->booted(function () {
                    Language::registerModule([Whatsapp::class]);
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
