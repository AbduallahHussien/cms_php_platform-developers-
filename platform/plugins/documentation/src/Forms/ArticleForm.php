<?php

namespace Botble\Documentation\Forms;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Forms\FieldOptions\ContentFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\FormAbstract;
use Botble\Documentation\Http\Requests\ArticleRequest;
use Botble\Documentation\Models\Article;
use Botble\Documentation\Models\Topic;

class ArticleForm extends FormAbstract
{
    public function setup(): void
    {
        info($this->getModel());
        $documentation_id = (int)$this->getModel()->documentation_id;

        $topics = Topic::where('documentation_id', $documentation_id)
                        ->where('status', BaseStatusEnum::PUBLISHED)
                        ->pluck('name', 'id') // key = id, value = name
                        ->toArray();
        

        $this
            ->setupModel(new Article())
            ->setValidatorClass(ArticleRequest::class)
            ->withCustomFields() 
            ->add('title', 'text', [
                'label' => trans('plugins/documentation::article.title'),
                'required' => true,
            ])
            ->add(
                'topic_id',  
                SelectField::class, 
                SelectFieldOption::make()
                ->label(trans('plugins/documentation::article.topic'))
                ->choices($topics)
                ->required())
            ->add('content', EditorField::class, ContentFieldOption::make()->required()->allowedShortcodes()->toArray())
            ->add('documentation_id', 'hidden', [ 
                'required' => true
            ]) 
            ->add('user_id', 'hidden', [ 
                'required' => true,
                'value' => $this->getModel()->user_id
            ])
            ->add('order', 'hidden', [ 
                'required' => true,
                'value' => $this->getModel()->order
            ])
            ->add('status', 'customSelect', [
                'label' => trans('core/base::tables.status'),
                'required' => true,
                'choices' => BaseStatusEnum::labels(),
            ])
            ->setBreakFieldPoint('status');
    }
}
