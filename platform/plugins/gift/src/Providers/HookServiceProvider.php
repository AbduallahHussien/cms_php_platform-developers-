<?php

namespace Botble\Gift\Providers;

use Botble\Base\Supports\ServiceProvider;
use Botble\Gift\Enums\GiftStatusEnum;
use Botble\Gift\Forms\Fronts\GiftForm;
use Botble\Gift\Forms\ShortcodeGiftAdminConfigForm;
use Botble\Gift\Http\Requests\GiftRequest;
use Botble\Gift\Models\Gift;
use Botble\Gift\Models\Cert;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\Shortcode\Facades\Shortcode as ShortcodeFacade;
use Botble\Theme\Facades\Theme;
use Botble\Theme\FormFrontManager;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        add_filter(BASE_FILTER_TOP_HEADER_LAYOUT, [$this, 'registerTopHeaderNotification'], 120);
        add_filter(BASE_FILTER_APPEND_MENU_NAME, [$this, 'getUnreadCount'], 120, 2);
        add_filter(BASE_FILTER_MENU_ITEMS_COUNT, [$this, 'getMenuItemCount'], 120);

        FormFrontManager::register(GiftForm::class, GiftRequest::class);

        if (class_exists(ShortcodeFacade::class)) {
            ShortcodeFacade::register(
                'gift-form',
                trans('plugins/gift::gift.shortcode_name'),
                trans('plugins/gift::gift.shortcode_description'),
                [$this, 'form']
            );

            ShortcodeFacade::setAdminConfig('gift-form', function (array $attributes) {
                return ShortcodeGiftAdminConfigForm::createFromArray($attributes);
            });
        }
    }

    public function registerTopHeaderNotification(?string $options): ?string
    {
        if (Auth::guard()->user()->hasPermission('gifts.edit')) {
            $gifts = Gift::query()
                ->where('status', GiftStatusEnum::UNREAD)
                ->select(['id', 'project-name', 'email', 'donor-phone', 'created_at'])
                ->orderByDesc('created_at')
                ->paginate(10);

            if ($gifts->total() == 0) {
                return $options;
            }

            return $options . view('plugins/gift::partials.notification', compact('gifts'))->render();
        }

        return $options;
    }

    public function getUnreadCount(string|null|int $number, string $menuId): int|string|null
    {
        if ($menuId !== 'cms-plugins-gift') {
            return $number;
        }

        return view('core/base::partials.navbar.badge-count', ['class' => 'unread-gifts'])->render();
    }

    public function getMenuItemCount(array $data = []): array
    {
        if (! Auth::guard()->user()->hasPermission('gifts.index')) {
            return $data;
        }

        $data[] = [
            'key' => 'unread-gifts',
            'value' => Gift::query()->where('status', GiftStatusEnum::UNREAD)->count(),
        ];

        return $data;
    }

    public function form(Shortcode $shortcode): string
    {
        $certs = Cert::query()->wherePublished()->get();
        $view = apply_filters(GIFT_FORM_TEMPLATE_VIEW, 'plugins/gift::forms.gift');

        if (defined('THEME_OPTIONS_MODULE_SCREEN_NAME')) {
            $this->app->booted(function () {
                Theme::asset()
                    ->usePath(false)
                    ->add('gift-css', asset('vendor/core/plugins/gift/css/gift-public.css'), [], [], '1.0.0');

                Theme::asset()
                   
                    ->usePath(false)
                    ->add(
                        'gift-public-js',
                        asset('vendor/core/plugins/gift/js/gift-public.js'),
                        ['jquery'],
                        [],
                        '1.0.0'
                    );
            });
        }

        if ($shortcode->view && view()->exists($shortcode->view)) {
            $view = $shortcode->view;
        }

        $form = GiftForm::createFromArray(
           $shortcode->toArray()
        );

        add_filter('gift_request_rules', function (array $rules, GiftRequest $request) use ($shortcode): array {
            return $request->applyRules($rules, $shortcode->display_fields, $shortcode->mandatory_fields);
        }, 120, 2);

        return view($view, compact('shortcode', 'form','certs'))->render();
    }
}
