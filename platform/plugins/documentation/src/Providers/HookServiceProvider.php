<?php

namespace Botble\Documentation\Providers;

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