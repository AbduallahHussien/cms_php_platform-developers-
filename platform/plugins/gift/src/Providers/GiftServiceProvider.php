<?php

namespace Botble\Gift\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Gift\Models\Gift;
use Botble\Gift\Models\GiftReply;
use Botble\Gift\Repositories\Eloquent\GiftReplyRepository;
use Botble\Gift\Repositories\Eloquent\GiftRepository;
use Botble\Gift\Repositories\Interfaces\GiftInterface;
use Botble\Gift\Repositories\Interfaces\GiftReplyInterface;
use Botble\Setting\PanelSections\SettingOthersPanelSection;
use Illuminate\Routing\Events\RouteMatched;

class GiftServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register(): void
    {
        $this->app->bind(GiftInterface::class, function () {
            return new GiftRepository(new Gift());
        });

        $this->app->bind(GiftReplyInterface::class, function () {
            return new GiftReplyRepository(new GiftReply());
        });
    }

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/gift')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions', 'email'])
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations()
            ->publishAssets();

        DashboardMenu::default()->beforeRetrieving(function () {
            DashboardMenu::make()
                ->registerItem([
                    'id' => 'cms-plugins-gift',
                    'priority' => 120,
                    'name' => 'plugins/gift::gift.menu',
                    'icon' => 'ti ti-gift',
                    'route' => 'gifts.index',
                ])
                ->registerItem([
                    'id' => 'cms-plugins-cert',
                    'priority' => 121,
                    'name' => 'plugins/gift::gift.cert',
                    'icon' => 'ti ti-certificate',
                    'route' => 'certs.index',
                ]);
        });

        PanelSectionManager::default()->beforeRendering(function () {
            PanelSectionManager::registerItem(
                SettingOthersPanelSection::class,
                fn () => PanelSectionItem::make('gift')
                    ->setTitle(trans('plugins/gift::gift.settings.title'))
                    ->withIcon('ti ti-mail-cog')
                    ->withPriority(140)
                    ->withDescription(trans('plugins/gift::gift.settings.description'))
                    ->withRoute('gift.settings')
            );
        });

      
        // $glyphsPath = app_path('Helpers/Arabic/Arabic/Glyphs.php');

        // if (file_exists($glyphsPath)) {
        //     require_once $glyphsPath;
        // }

        $this->publishes([
            __DIR__ . '/../../resources/assets' => public_path('vendor/core/plugins/gift/assets/fonts'),
        ]);

        $this->app->booted(function () {
            $this->app->register(HookServiceProvider::class);
        });
    }
}
