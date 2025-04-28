<?php

namespace Botble\PluginUploader\Providers;

use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Supports\ServiceProvider; 
use Botble\Documentation\Models\Documentation;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\Shortcode\Facades\Shortcode as ShortcodeFacade;
use Botble\Shortcode\Forms\ShortcodeForm;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (function_exists('add_shortcode')) 
        {
            shortcode()->register(
                    'plugin_uploader',
                    trans('plugins/plugin_uploader::base.short_code_name'),
                    trans('plugins/plugin_uploader::base.short_code_description'),
                    [$this, 'renderPluginUploader']
            );
        }
    }

    public function renderPluginUploader(Shortcode $shortcode): array|string
    {
        $view = 'plugins/plugin_uploader::index';
        
        return view($view)->render();
    }
}