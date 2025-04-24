<?php

namespace Botble\Documentation\Providers;

use Botble\Base\Facades\Assets;
use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Supports\ServiceProvider; 
use Botble\Dashboard\Events\RenderingDashboardWidgets;
use Botble\Dashboard\Supports\DashboardWidgetInstance;
use Botble\Documentation\Models\Documentation;
use Botble\Media\Facades\RvMedia;
use Botble\Menu\Events\RenderingMenuOptions;
use Botble\Menu\Facades\Menu;
use Botble\Page\Models\Page;
use Botble\Page\Tables\PageTable;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\Shortcode\Facades\Shortcode as ShortcodeFacade;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Slug\Models\Slug;
use Botble\Theme\Events\RenderingAdminBar;
use Botble\Theme\Events\RenderingThemeOptionSettings;
use Botble\Theme\Facades\AdminBar;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (function_exists('add_shortcode')) 
        {
            shortcode()->register(
                    $shortcodeName = 'documentation',
                    trans('plugins/documentation::base.short_code_name'),
                    trans('plugins/documentation::base.short_code_description'),
                    [$this, 'renderDocumentationArticles']
                )
                ->setAdminConfig(
                    $shortcodeName,
                    function (array $attributes) 
                    {
                        $documentations = Documentation::query()
                                                       ->wherePublished()
                                                       ->pluck('name', 'id')
                                                       ->all();

                        return ShortcodeForm::createFromArray($attributes)  
                            ->add(
                                'documentation_id',
                                SelectField::class,
                                SelectFieldOption::make()
                                    ->label(__('Select Documentation'))
                                    ->choices($documentations) 
                                    ->searchable() 
                                    ->toArray()
                            );
                    }
                );
        }

        
    }

    public function renderDocumentationArticles(Shortcode $shortcode): array|string
        {
            $documentation_id = ShortcodeFacade::fields()->getIds('documentation_id', $shortcode);

            $documentation = Documentation::query()
                ->wherePublished()
                ->orderByDesc('created_at')
                ->where('id',$documentation_id)->first();

            $view = 'plugins/documentation::home';
           

            return view($view, compact('documentation'))->render();
        }
}