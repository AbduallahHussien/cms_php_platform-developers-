<?php

namespace Botble\Documentation\Providers;

use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Base\Facades\DashboardMenu;
use Botble\Documentation\Models\Documentation;
use Botble\Theme\Facades\Theme;

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
                    'icon' => 'fa fa-file',
                    'url' => route('documentation.index'),
                    'permissions' => ['documentation.index'],
                ]);
            });

            
            

            // if (function_exists('add_shortcode')) {
            //     shortcode()
            //         ->register(
            //             $shortcodeName = 'documentation',
            //             trans('plugins/blog::base.short_code_name'),
            //             trans('plugins/blog::base.short_code_description'),
            //             [$this, 'renderBlogPosts']
            //         )
            //         ->setAdminConfig(
            //             $shortcodeName,
            //             function (array $attributes) {
            //                 $categories = Category::query()
            //                     ->wherePublished()
            //                     ->pluck('name', 'id')
            //                     ->all();
    
            //                 return ShortcodeForm::createFromArray($attributes)
            //                     ->withLazyLoading()
            //                     ->add('paginate', 'number', [
            //                         'label' => trans('plugins/blog::base.number_posts_per_page'),
            //                         'attr' => [
            //                             'placeholder' => trans('plugins/blog::base.number_posts_per_page'),
            //                         ],
            //                     ])
            //                     ->add(
            //                         'category_ids[]',
            //                         SelectField::class,
            //                         SelectFieldOption::make()
            //                             ->label(__('Select categories'))
            //                             ->choices($categories)
            //                             ->when(Arr::get($attributes, 'category_ids'), function (SelectFieldOption $option, $categoriesIds) {
            //                                 $option->selected(explode(',', $categoriesIds));
            //                             })
            //                             ->multiple()
            //                             ->searchable()
            //                             ->helperText(__('Leave categories empty if you want to show posts from all categories.'))
            //                             ->toArray()
            //                     );
            //             }
            //         );
            // }

            
            // add_shortcode('documentation', 'Documentation', 'View Topics and Articles', function() 
            // {
                
            //     // return "hello";
            //     $id = 1;
            //     return view('plugins/documentation::home',['id' => $id])->render(); 
            //     // return Theme::layout('documentation')->render();
            // });
            
            $this->app->booted(function () 
            { 
                $this->app->register(HookServiceProvider::class);
            });
    }
}
