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
use Botble\Whatsapp\Http\Services\UltramsgService;
use Botble\Whatsapp\Models\WhatsappSetting;
use Illuminate\Routing\Events\RouteMatched;
use Botble\Whatsapp\Providers\EventServiceProvider;
use Exception;
use UltraMsg\WhatsAppApi;
use Illuminate\Support\Facades\Schema;
class WhatsappServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    protected function loadPluginDependencies(): void
    {
          // Only load plugin autoloader if necessary
        try
        { 
            if (!class_exists(\Kreait\Firebase\Factory::class) &&
                !class_exists(\Mimey\MimeTypes::class)) 
            {
                // info('class not exists');
                // $autoload = __DIR__ . '/../../vendor/autoload.php';
                $autoload = plugin_path('whatsapp/vendor/autoload.php');
    
                if (file_exists($autoload)) {
                    require_once $autoload;
                    // info('Plugin autoloader was found and loaded!'); // Add this for debugging
                } else {
                    // info('Plugin autoloader NOT FOUND at: ' . $autoload); // Add this for debugging
                }
            }
            else
            {
                // info('no need to autoload');
            }
        }catch(Exception $ex)
        {
            info($ex->getMessage());
        }
    }

    public function register()
    {
        $this->loadPluginDependencies();
        
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


        // We use a singleton because we only need one instance of the WhatsAppApi class.
        $this->app->singleton(UltramsgService::class, function () {
            $instanceId = null;
            $token = null;
            // It's good practice to check if the table exists before querying it.
            // This prevents errors during migrations or initial setup.
            if (Schema::hasTable('whatsapp_settings')) {
                // Fetch the first row of settings.
                // You might need to adjust this if you store settings differently.
                $settings = WhatsappSetting::first();
                $instanceId = $settings?->ultramsg_whatsapp_instance_id;
                $token = $settings?->ultramsg_whatsapp_token; 
                $whatsappId = $settings?->whatsapp_id; 
                
            }
            // Return a new instance of the WhatsAppApi.
            // If settings are not found, it will be instantiated with null values,
            // which will likely cause an error when you try to use it,
            // reminding you to configure the settings.

            return new UltramsgService($token, $instanceId,$whatsappId);
        });


        
    }

    public function boot()
    {
        // info('booted');
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
